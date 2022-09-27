<template>
  <div>
    <Loader v-if="loader" />
    <div v-else class="screen-width">
      <div class="flex flex-wrap">
        <div class="w-full md:w-3/5 lg:w-2/3">
          <div
            class="
              h-64
              w-full
              bg-cover
              rounded-md
              md:h-screen
              2xl:bg-contain
              lg:bg-top lg:h-full
              bg-no-repeat bg-center
            "
            style="background: url(/assets/images/cover.png)"
          ></div>
        </div>
        <div class="w-full md:w-2/5 lg:w-1/3 px-6 py-10">
          <h3 class="font-bold mb-2">{{ item.name }}</h3>
          <span class="block mb-4">Minimun bid {{ item.min_bid }}$</span>
          <p class="mb-6 font-thin leading-relaxed text-sm">
            <span class="block font-semibold">Details</span>
            <span>{{ itemDetails(item.details) }}</span>

            <span v-if="item.details.length > 500">
              <span v-if="hasReadMore">... </span>
              <span class="text-purple-400 cursor-pointer ml-1 text-xs">
                <span v-if="hasReadMore" @click="hasReadMore = false">
                  Read More
                </span>
                <span v-else @click="hasReadMore = true">Read Less</span>
              </span>
            </span>
          </p>

          <div class="flex justify-between mb-6">
            <div>
              <span class="block">Last bid Made</span>
              <span class="block font-semibold"> {{ item.max_bid }}$ </span>
            </div>
            <div>
              <span class="block">Available Untill</span>
              <span class="block font-semibold">{{ formatDataTime() }}</span>
            </div>
          </div>

          <!-- bid now -->
          <div>
            <div v-if="isLoggedIn && !isClosed">
              <div v-if="!item.hasAutoBid">
                <CustomForm
                  requestType="put"
                  :url="`/api/items/${id}`"
                  saveBtnText="Place A bid"
                  saveBtnClass="w-full btn btn-primary mb-2"
                >
                  <template #content="{ fields }">
                    <FormInput
                      isRequired
                      iconText="$"
                      type="number"
                      v-model="fields.max_bid"
                      :bindOptions="{ min: +item.max_bid + 1 }"
                      :placeholder="`Bid Now with more than ${item.max_bid}$`"
                    />
                  </template>
                </CustomForm>
                <span class="cursor-pointer" @click="autoBiddingModal = true">
                  Activate the <span class="underline">auto bidding</span>
                </span>
              </div>
              <div v-else>
                <div v-if="item.hasAutoBid">
                  <div
                    class="
                      p-4
                      w-full
                      bg-green-100
                      text-green-700
                      border-l-4 border-green-500
                    "
                  >
                    auto bidding has activated {{ item.max_auto_bid }}$
                    <Custom-btn
                      text="Stop it"
                      :loading="stopBtnLoading"
                      @click.native="stopAutoBidding"
                      cssClass="underline text-green-900 cursor-pointer font-semibold"
                    />
                  </div>
                </div>
              </div>
            </div>
            <div v-else-if="isLoggedIn && isClosed">
              <div
                class="
                  p-4
                  bg-orange-100
                  text-orange-700
                  border-l-4 border-orange-500
                "
              >
                <p class="font-bold">Be Warned</p>
                <p>This Item is closed, so you can't bid on it.</p>
              </div>
            </div>
            <div v-else>
              <div
                class="
                  p-4
                  bg-orange-100
                  text-orange-700
                  border-l-4 border-orange-500
                "
              >
                <p class="font-bold">Be Warned</p>
                <p>
                  You have to
                  <router-link to="/login" class="font-bold">login</router-link>
                  first to be able to make a bid
                </p>
              </div>
            </div>
          </div>

          <!-- auto bidding modal -->
          <Modal v-if="autoBiddingModal" @close="autoBiddingModal = false">
            <template #content>
              <div class="mb-6 border-b pb-2">
                <h3 class="font-bold text-center text-gray-800">
                  Configure The Auto-Bidding
                </h3>
              </div>
              <CustomForm
                @success="autoBid"
                :url="`/api/items/${id}/auto-bid`"
                saveBtnText="Place Auto bid"
                saveBtnClass="w-full btn btn-primary mb-2"
              >
                <template #content="{ fields }">
                  <FormInput
                    isRequired
                    iconText="$"
                    class="mb-4"
                    type="number"
                    label="Maximun Bid Amount"
                    v-model="fields.max_auto_bid"
                    placeholder="Maximun Bid Amount"
                    :bindOptions="{ min: +item.max_bid + 1 }"
                  />
                  <FormInput
                    iconText="%"
                    class="mb-4"
                    type="number"
                    v-model="fields.alert_when"
                    label="Bid Alert Notification"
                    placeholder="Bid Alert Notification"
                    :bindOptions="{ min: 1, max: 100 }"
                  />
                </template>
              </CustomForm>
            </template>
          </Modal>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from "vuex";
import moment, { now } from "moment";
import Modal from "./../../components/Modal.vue";
import CustomBtn from "../../components/CustomBtn.vue";
import FormInput from "./../../components/FormInput.vue";
import CustomForm from "./../../components/CustomForm.vue";

export default {
  components: { CustomForm, FormInput, Modal, CustomBtn },
  data() {
    return {
      item: {},
      loader: true,
      hasReadMore: true,

      isClosed: false,
      stopBtnLoading: false,

      autoBidObj: {},
      autoBidBtn: false,
      hasAutoBid: false,
      autoBiddingModal: false,
    };
  },

  computed: {
    ...mapGetters(["isLoggedIn"]),

    id() {
      return this.$route.params.id;
    },
  },

  methods: {
    getItmeData() {
      this.axios.get(`/api/items/${this.id}`).then(({ data }) => {
        this.item = data;
        this.loader = false;
      });
    },

    formatDataTime() {
      let atThisMoment = moment(now());
      let until = moment(this.item.available_untill);
      if (atThisMoment.isBefore(until)) {
        let { _data } = moment.duration(until.diff(atThisMoment));
        let time = "";

        //years Format
        if (_data.years) {
          if (_data.years != 1) {
            time += `${_data.years} Years, `;
          } else {
            time += `a Year, `;
          }
        }

        //months Format
        if (_data.months) {
          if (_data.months != 1) {
            time += `${_data.months} months, `;
          } else {
            time += `a Month, `;
          }
        }

        //years Format
        if (_data.days) {
          if (_data.days != 1) {
            time += `${_data.days} Days, `;
          } else {
            time += `a Day, `;
          }
        }

        //hours Format
        if (_data.hours) {
          if (_data.hours < 10) {
            time += `0${_data.hours}:`;
          } else {
            time += `${_data.hours}:`;
          }
        } else {
          time += `00:`;
        }

        //minutes Format
        if (_data.minutes) {
          if (_data.minutes < 10) {
            time += `0${_data.minutes}:`;
          } else {
            time += `${_data.minutes}:`;
          }
        } else {
          time += `00:`;
        }

        //seconds Format
        if (_data.seconds) {
          if (_data.seconds < 10) {
            time += `0${_data.seconds}`;
          } else {
            time += `${_data.seconds}`;
          }
        } else {
          time += `00`;
        }

        return time;
      } else {
        this.isClosed = true;
        return "This bidding is closed";
      }
    },

    autoBid() {
      this.autoBiddingModal = false;
    },

    stopAutoBidding() {
      this.stopBtnLoading = true;
      this.axios
        .delete(`/api/auto-bid/${this.id}`)
        .then(({ data }) => {
          this.item = data;
        })
        .finally(() => (this.stopBtnLoading = false));
    },

    itemDetails(desc) {
      if (desc.length > 500) {
        if (this.hasReadMore) {
          return desc.slice(500);
        }
        return desc;
      } else {
        return desc;
      }
    },
  },

  created() {
    this.getItmeData();
  },

  mounted() {
    setInterval(() => {
      this.$forceUpdate(() => this.formatDataTime());
    }, 1000);

    this.$echo
      .private(`item-has-bid-${this.$store.state.user.id}`)
      .listen("ItemWithBidsEvent", ({ itemWithBid }) => {
        this.hasAutoBid = true;
        this.$set(this, "item", itemWithBid);
      });

    this.$echo.channel("update-item").listen("ItemEvent", ({ item }) => {
      if (this.hasAutoBid) {
        this.hasAutoBid = false;
        return;
      }

      if (this.id == item.id) {
        this.$set(this, "item", item);
        this.$emit("clear-errors");
      }
    });
  },
};
</script>