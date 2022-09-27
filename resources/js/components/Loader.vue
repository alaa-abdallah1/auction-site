<template>
  <div class="absolute inset-2/4">
    <div class="flex flex-col justify-center items-center">
      <div
        class="
          h-16
          w-16
          animate-spin
          rounded-full
          border-t-2 border-b-2 border-purple-500
        "
      ></div>
    </div>
  </div>
</template>

<script>
export default {
  //
};
</script>

<style scoped>
.loader {
  border-top-color: #3498db;
  -webkit-animation: spinner 1.5s linear infinite;
  animation: spinner 1.5s linear infinite;
}

@-webkit-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
  }
}

@keyframes spinner {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}
</style>