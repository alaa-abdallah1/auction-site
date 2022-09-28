<template>
    <div>
        <nav class="bg-white shadow">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <router-link
                                to="/"
                                class="font-semibold italic text-primary"
                            >
                                Auction UK
                            </router-link>
                        </div>
                    </div>

                    <div class="flex">
                        <div class="ml-4 flex items-center md:ml-6">
                            <router-link
                                v-if="!isLoggedIn"
                                to="/login"
                                class="mr-6"
                                >Login</router-link
                            >
                            <div
                                v-if="isLoggedIn"
                                class="ml-3 relative"
                                @click="showProfileMenu = true"
                                v-click-outside="
                                    () => (showProfileMenu = false)
                                "
                            >
                                <div>
                                    <button
                                        type="button"
                                        id="user-menu"
                                        aria-haspopup="true"
                                        aria-expanded="false"
                                        class="
                                            flex
                                            text-sm
                                            max-w-xs
                                            text-gray-800
                                            rounded-full
                                            items-center
                                            focus:outline-none
                                        "
                                    >
                                        <div class="text-sm font-medium mr-2">
                                            {{ user.name }}
                                        </div>
                                        <div>
                                            <img
                                                src="/assets/images/profile-icon.png"
                                                style="
                                                    width: 100%;
                                                    height: 100%;
                                                "
                                            />
                                        </div>
                                    </button>
                                </div>
                                <div
                                    v-if="showProfileMenu"
                                    class="
                                        mt-2
                                        py-1
                                        w-56
                                        right-0
                                        absolute
                                        shadow-lg
                                        rounded-md
                                        bg-white
                                        origin-top-right
                                        focus:outline-none
                                        ring-1 ring-black ring-opacity-5
                                    "
                                    role="menu"
                                    aria-orientation="vertical"
                                    aria-labelledby="user-menu"
                                >
                                    <span
                                        @click="logout"
                                        class="
                                            block
                                            px-4
                                            py-2
                                            text-base
                                            font-medium
                                            cursor-pointer
                                            text-gray-700
                                            hover:bg-gray-100
                                        "
                                    >
                                        Logout
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</template>

<script>
import { mapState, mapGetters } from "vuex";
import ClickOutside from "vue-click-outside";

export default {
    directives: {
        ClickOutside,
    },
    data() {
        return {
            showMobileMenu: false,
            showProfileMenu: false,
        };
    },
    computed: {
        ...mapState(["user"]),
        ...mapGetters(["isLoggedIn"]),
    },
    methods: {
        logout() {
            this.$store.dispatch("logout");
        },
    },
    watch: {
        $route() {
            this.showProfileMenu = false;
        },
    },

    mounted() {
        this.$echo
            .private(`notify-with-bid-${this.$store.state.user.id}`)
            .listen("AutoBidEvent", ({ autoBid, message }) => {
                let msg, type, title;
                if (message == "canceled") {
                    type = "error";
                    title = "Bid Has Canceled";
                    msg = `Your bid on <span id="alert-user" class="font-bold text-red-400">
                         this item ( ${autoBid.item.name} )
                      </span> 
                      has closed because you don't have enough balance <br />.
                      Do you want to visit it?`;
                } else {
                    type = "warning";
                    title = "Bid Reached Maximum Value";
                    msg = `Your bid on <span id="alert-user" class="font-bold text-orange-400">
                         this item ( ${autoBid.item.name} )
                      </span> 
                      has reached the maximum value that reserved <br />.
                      Do you want to visit it?`;
                }
                this.$fire({
                    title: title,
                    html: msg,
                    type: type,
                    timer: 30000,
                    showCloseButton: true,
                    showCancelButton: true,
                }).then(() => {
                    if (this.$route.path != `/items/${autoBid.item_id}`) {
                        this.$router.push(`/items/${autoBid.item_id}`);
                    }
                });
            });
    },
};
</script>
