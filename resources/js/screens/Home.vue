<template>
  <div>
    <Loader v-if="loader" />
    <div v-else class="screen-width">
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        <div
          :key="index"
          v-for="(item, index) in items"
          class="w-full card overflow-hidden flex flex-col justify-center"
        >
          <div class="bg w-full h-64 flex justify-center">
            <div
              class="w-full h-full bg-cover bg-no-repeat bg-center"
              style="background: url(/assets/images/cover.png)"
            ></div>
          </div>
          <div class="p-2">
            <h4 class="truncate mb-1">{{ item.name }}</h4>
            <div class="flex flex-wrap items-center justify-between">
              <span>{{ item.max_bid || item.min_bid }}$</span>
              <router-link
                :to="`/items/${item.id}`"
                class="
                  transition-all
                  text-white
                  bg-purple-600
                  hover:bg-purple-700
                  rounded
                  text-xs
                  p-1
                "
              >
                Bid Now
              </router-link>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      items: [],
      loader: true,
    };
  },

  methods: {
    getItmes() {
      this.axios.get("/api/items").then(({ data }) => {
        this.items = data;
        this.loader = false;
      });
    },
  },

  created() {
    this.getItmes();
  },

  mounted() {
    this.$echo.channel("update-item").listen("ItemEvent", (payload) => {
      this.items = this.items.map((item) => {
        return item.id === payload.item.id ? payload.item : item;
      });
    });
  },
};
</script>