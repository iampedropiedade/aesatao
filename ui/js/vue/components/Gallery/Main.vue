<template>
  <div class="image-gallery" v-if="images.length > 0">
    <div class="row">
      <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 image" v-for="(image, index) in images">
        <div class="img-wrapper" v-on:click="openModal(index)" role="button">
          <div>
            <img :src="image.thumbnail" class="img-responsive" alt="Gallery image">
          </div>
          <div class="img-overlay">
            <i class="fa-solid fa-image"></i>
          </div>
        </div>
      </div>
    </div>
    <div class="gallery-modal" v-if="showModal">
      <div class="gallery-modal-content">
        <button v-on:click="previousImage()" class="btn-text btn-gallery-modal btn-gallery-modal--previous"><i class="fa fa-chevron-left"></i></button>
        <img :src="currentImage">
        <button v-on:click="nextImage()" class="btn-text btn-gallery-modal btn-gallery-modal--next"><i class="fa fa-chevron-right"></i></button>
        <button v-on:click="closeModal()" class="btn-text btn-gallery-modal btn-gallery-modal--close"><i class="fa fa-times"></i></button>
      </div>
    </div>
  </div>
</template>
<script>

export default {
  name: 'Gallery',
  props: {
    images: {required: true, type: Array},
  },
  data() {
    return {
      showModal: false,
      currentImage: '',
      currentIndex: 0
    }
  },
  methods: {
  },
  created: function () {
  },
}
</script>