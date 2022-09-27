<template>
  <div>
    <button
      :type="type"
      :class="cssClass"
      :disabled="loading"
      class="flex flex-col items-center justify-center"
    >
      <svg
        v-if="loading"
        width="21"
        height="21"
        stroke="#ccc"
        class="absolute"
        viewBox="0 0 38 38"
        xmlns="http://www.w3.org/2000/svg"
      >
        <g fill="none" fill-rule="evenodd">
          <g transform="translate(1 1)" stroke-width="2">
            <circle stroke-opacity=".5" cx="18" cy="18" r="18" />
            <path d="M36 18c0-9.94-8.06-18-18-18">
              <animateTransform
                attributeName="transform"
                type="rotate"
                from="0 18 18"
                to="360 18 18"
                dur="1s"
                repeatCount="indefinite"
              />
            </path>
          </g>
        </g>
      </svg>
      <span :class="loading && 'invisible'"> {{ text }} </span>
    </button>
  </div>
</template>

<script>
export default {
  props: {
    type: String,
    text: { type: String, default: "Save" },
    loading: { type: Boolean, default: false },
    cssClass: { type: String, default: "btn btn-primary" },
  },
};
</script>
