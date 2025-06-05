<template>
  <div id="googleForm" v-once class="google-form-wrapper" ref="wrapper">
    <iframe :src="getUrl()" class="w-full border-0" :style="getStyle()">
      Loading...
    </iframe>
  </div>
</template>
<script>
export default {
  name: 'GoogleForm',
  props: {
    embedUrl: {required: true, type: String},
    formHeight: {required: false, type: String, default: '800px'},
  },
  data() {
    return {
      isLoaded: false
    }
  },
  methods: {
    getUrl() {
      return this.embedUrl + '&hl=pt';
    },
    getStyle() {
      return 'height: ' + this.formHeight;
    },
    initializeStyles() {
      const iframe = this.$refs.wrapper.querySelector('iframe')
      if (iframe) {
        iframe.addEventListener("load", function() {
          this.isLoaded = true
        });
      }
    },
  },
  mounted() {
    this.initializeStyles()
  },
}
</script>