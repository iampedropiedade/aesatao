<template>
  <div class="accordion-wrapper">
    <div class="accordion" v-for="(entry, index) in accordionEntries">
      <button class="accordion-header" :aria-expanded="entry.expanded === true" :aria-controls="'accordion-title-' + index" v-on:click="openEntry(index)" role="button">
        <i class="fa-solid fa-minus me-4" v-if="entry.expanded"></i>
        <i class="fa-solid fa-plus me-4" v-else></i>
        <span>{{ entry.title }}</span>
      </button>
      <div :id="'accordion-title-' + index"
           :aria-labelledby="'accordion-title-' + index"
           class="accordion-content"
           :class="{'opacity-100 active grid-rows-[1fr]': entry.expanded, 'grid-rows-[0fr] opacity-0': !entry.expanded}"
      >
        <div class="overflow-hidden">
          <div class="p-5" v-html="entry.description">
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: 'Accordion',
  props: {
    entries: {required: true, type: Array},
  },
  data() {
    return {
      accordionEntries: []
    }
  },
  methods: {
    openEntry(index) {
      let newStatus = !this.accordionEntries[index].expanded;
      this.closeAll()
      this.accordionEntries[index].expanded = newStatus;
    },
    closeAll() {
      this.accordionEntries.forEach(entry => entry.expanded = false)
    },
  },
  created: function () {
    this.accordionEntries = this.entries
    this.closeAll()
  },
}
</script>