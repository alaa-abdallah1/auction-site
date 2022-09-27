<template>
  <div>
    <div v-if="hasManyErrors">
      <ul
        v-if="Object.keys(errors).length !== 0"
        class="bg-red-400 p-4 mb-2 rounded"
      >
        <li v-for="(error, index) in errors" :key="index">{{ error[0] }}</li>
      </ul>
    </div>
    <div v-else>
      <ul
        v-if="Object.keys(errors).length !== 0"
        class="bg-orange-100 text-orange-700 p-4 mb-2 rounded"
      >
        <li v-for="(error, index) in errors" :key="index">{{ error }}</li>
      </ul>
    </div>

    <form @submit.prevent="submit">
      <slot name="content" :fields="fields"></slot>
      <CustomBtn
        class="mt-4"
        :text="saveBtnText"
        :loading="loadingBtn"
        :cssClass="saveBtnClass"
      />
    </form>
  </div>
</template>

<script>
import CustomBtn from "./CustomBtn.vue";

export default {
  components: { CustomBtn },
  props: {
    url: {
      type: String,
      required: true,
    },
    requestType: {
      type: String,
      default: "post",
    },
    payload: {
      type: Object,
      default: () => {},
    },
    saveBtnText: {
      type: String,
      default: "Login",
    },
    saveBtnClass: String,
  },
  data() {
    return {
      errors: {},
      hasManyErrors: true,

      fields: {},
      loadingBtn: false,
    };
  },

  methods: {
    submit() {
      this.errors = {};
      this.loadingBtn = true;
      const payload = { ...this.fields, ...this.payload };

      this.axios[this.requestType](this.url, { ...payload })
        .then((res) => {
          this.fields = {};
          this.$emit("success", res);
        })
        .catch(({ response }) => {
          if (response.data.errors) {
            this.hasManyErrors = true;
            this.errors = response.data.errors;
          } else {
            this.hasManyErrors = false;
            this.errors = response.data;
          }
        })
        .finally(() => (this.loadingBtn = false));
    },
  },

  mounted() {
    this.$parent.$on("clear-errors", () => (this.errors = {}));
  },
};
</script>