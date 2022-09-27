<template>
  <!-- auto bidding modal -->
  <div
    role="dialog"
    aria-modal="true"
    aria-labelledby="modal-title"
    class="fixed z-10 inset-0 overflow-y-auto"
  >
    <div
      class="
        flex
        pt-4
        px-4
        pb-20
        items-end
        text-center
        min-h-screen
        justify-center
        sm:block sm:p-0
      "
    >
      <div
        class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
        aria-hidden="true"
      ></div>

      <span
        class="hidden sm:inline-block sm:align-middle sm:h-screen"
        aria-hidden="true"
        >&#8203;
      </span>

      <div
        class="
          rounded
          text-left
          shadow-xl
          transform
          bg-white
          inline-block
          align-bottom
          transition-all
          overflow-hidden
          sm:my-8 sm:align-middle sm:max-w-lg sm:w-full
        "
      >
        <div class="w-full mb-1">
          <span
            @click="$emit('close')"
            class="
              m-1
              px-2
              py-1
              rounded
              float-right
              cursor-pointer
              bg-purple-600
              hover:bg-purple-700
              text-white text-xs
            "
            >x</span
          >
        </div>
        <div class="p-4">
          <slot name="content" />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import CustomBtn from "./CustomBtn.vue";

export default {
  components: { CustomBtn },

  mounted() {
    window.addEventListener(
      "keydown",
      (e) => e.keyCode === 27 && this.$emit("close")
    );
  },
};
</script>