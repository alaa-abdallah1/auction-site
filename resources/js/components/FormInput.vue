<template>
  <div class="flex w-full flex-wrap items-stretch mt-1">
    <label v-if="label" :for="id" class="text-gray-600 font-thin">
      {{ label }} <span v-if="isRequired" class="text-red-300">*</span>
    </label>
    <div class="relative flex w-full flex-wrap items-stretch">
      <span
        v-if="iconText"
        class="
          w-8
          pl-3
          py-3
          z-10
          h-full
          rounded
          absolute
          text-base
          font-normal
          leading-snug
          items-center
          justify-center
          bg-transparent
          text-center text-blueGray-300
        "
      >
        {{ iconText }}
      </span>
      <input
        :id="id"
        :type="type"
        :value="value"
        v-bind="bindOptions"
        :required="isRequired"
        @input="
          $emit(
            'input',
            type === 'number' ? +$event.target.value : $event.target.value
          )
        "
        :placeholder="placeholder"
        class="
          px-2
          py-3
          shadow
          w-full
          rounded
          text-sm
          border-0
          bg-white
          outline-none
          text-blueGray-600
          placeholder-blueGray-300
          focus:outline-none focus:ring
        "
        :class="[iconText && 'pl-10 relative']"
      />
    </div>
  </div>
</template>

<script>
export default {
  props: {
    type: {
      type: String,
      required: true,
    },
    label: String,
    iconText: String,
    placeholder: String,
    bindOptions: Object,
    isRequired: Boolean,
    value: [String, Number],
  },
  computed: {
    id() {
      return `id-${Math.random() * 52485}`;
    },
  },
};
</script>