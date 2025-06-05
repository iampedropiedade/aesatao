<template>
  <div class="min-w-[1rem] text-[0.7rem] font-semibold">
    {{ loadingText }}
  </div>
</template>
<script>

export default {
  name: 'Thinking',
  data() {
    return {
      loadingText: "",
      dots: ["", ".", "..", "..."],
      dotIndex: 0,
      intervalId: null,
    }
  },
  methods: {
    thinkingLoadingAnimationStart() {
      this.intervalId = setInterval(() => {
        this.dotIndex = (this.dotIndex + 1) % this.dots.length;
        this.loadingText = this.dots[this.dotIndex];
      }, 500);
    },
    thinkingLoadingAnimationStop() {
      if (this.intervalId) {
        clearInterval(this.intervalId);
      }
    }
  },
  unmounted: function () {
    this.thinkingLoadingAnimationStop()
  },
  mounted: function () {
    this.thinkingLoadingAnimationStart()
  },
}
</script>