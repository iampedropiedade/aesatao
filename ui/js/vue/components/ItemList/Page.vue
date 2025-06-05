<template>
  <article class="card !shadow-[0_0.25rem_1.75rem_rgba(30,34,40,0.07)] lift !h-full">
    <div class="card-body p-5 flex flex-col h-full">
      <div class="fle mb-2" v-if="(item.tags !== undefined) && (item.tags.length > 0)">
        <button class="badge bg-brightGray !text-royalBlue rounded py-1 mr-2" v-for="(tag) in item.tags" v-on:click="filterByTag(tag)">{{ tag.tag }}</button>
      </div>
      <a :href="item.url" class="grow" :target="item.target">
        <h3 class="!mb-4">{{ item.title }}</h3>
        <div class="mb-4 text-darkElectricBlue grow">{{ item.description }}</div>
      </a>
      <div class="inline-block text-[0.65rem]" v-if="cardStyle === 'page_with_date'">
        <i class="fa-regular fa-calendar pr-2"></i>
        Publicado
        <span>{{ $dayjs(item.date.date).fromNow() }}</span>
      </div>
    </div>
  </article>
</template>
<script>

export default {
  name: 'PageCard',
  props: {
    item: {required: false, type: Object},
    cardStyle: {required: false, type: String, default: 'page'},
  },
  emits: ['filterByTag'],
  data() {
    return {
    }
  },
  methods: {
    filterByTag(tag) {
      this.$emit('filterByTag', tag)
    },
    load() {
    },
  },
  created: function () {
  },
}
</script>