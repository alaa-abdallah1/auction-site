<template>
  <div>
    <Loader v-if="!startPage" />
    <div v-else>
      <Navbar />
      <router-view></router-view>
    </div>
  </div>
</template>

<script>
import Navbar from "./partials/Navbar.vue";
import { mapState, mapMutations } from "vuex";

export default {
  components: { Navbar },

  computed: {
    ...mapState(["startPage"]),
  },

  methods: {
    ...mapMutations(["startPageStatus", "getUserData"]),
  },

  mounted() {
    this.axios.interceptors.response.use(
      (response) => response,
      (error) => {
        if (error.response.status === 401) {
          this.startPageStatus(true);
          this.$store.dispatch("logout");
        }
        if (error.response.status === 404) {
          this.$router.push({ name: "NotFound" });
        }
        return Promise.reject(error);
      }
    );

    this.axios.defaults.headers.common["Accept"] = "application/json";
    if (localStorage.getItem("token")) {
      this.axios.defaults.headers.common["Authorization"] =
        "Bearer " + localStorage.getItem("token");
      this.getUserData();
    } else {
      this.startPageStatus(true);
    }
  },
};
</script>