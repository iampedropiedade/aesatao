<template>
  <div id="hubspotForm" v-once class="hubspot-form-wrapper" ref="wrapper"></div>
</template>
<script>
export default {
  name: 'hubspotForm',
  props: {
    portalId: {required: true, type: Number},
    formId: {required: true, type: String},
    region: {required: true, type: String},
    hubspotScript: {required: true, type: String},
    stylesHref: {required: true, type: String},
  },
  data() {
    return {
    }
  },
  methods: {
    initializeStyles() {
      const cssLink = document.createElement("link")
      cssLink.href = this.stylesHref + "?ts=" + Date.now()
      cssLink.rel = "stylesheet"
      cssLink.type = "text/css"

      const fontLink = document.createElement("link")
      fontLink.href = "https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      fontLink.rel = "stylesheet"
      fontLink.type = "text/css"

      const iframe = this.$refs.wrapper.querySelector('iframe')
      if (iframe) {
        iframe.contentWindow.document.head.appendChild(fontLink)
        iframe.contentWindow.document.head.appendChild(cssLink)
      }
    },
  },
  mounted() {
    let hubspotScript = document.createElement('script')
    hubspotScript.setAttribute('src', this.hubspotScript)
    document.head.appendChild(hubspotScript)
    hubspotScript.addEventListener("load", () => {
      if (window.hbspt) {
        window.hbspt.forms.create({
          region: this.region,
          portalId: this.portalId,
          formId: this.formId,
          target: "#hubspotForm",
          locale: "pt",
          onFormReady: () => {
            this.initializeStyles()
          },
          translations: {
            pt: {
              required: "Este campo é de preenchimento obrigatório",
              fieldLabels: {
                email: "Endereço de email",
              }
            }
          }
        })
      }
    })
  },
}
</script>