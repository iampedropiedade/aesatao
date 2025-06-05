<template>
  <div class="blog relative rounded-md shadow-lg dark:shadow-gray-800 overflow-hidden h-full flex flex-row border border-gray-100">
    <a class="relative md:w-1/3 w-0 h-full bg-table bg-center bg-no-repeat bg-cover hidden lg:block" :href="item.url" :style="'background-image: url(\'' + item.thumbnailUrl + '\');'">
    </a>
    <div class="content p-6  md:w-2/3 w-full flex flex-col">
      <h3 class="h3 text-2xl font-medium !m-0 !mb-2">
        {{ item.title }}
      </h3>
      <div class="text-slate-500 mt-3 grow">
        {{ item.description }}
      </div>
      <div class="mt-3">
        <a :href="item.url" class="relative font-semibold inline-block tracking-wide align-middle text-sm text-center border-none after:content-[''] after:absolute after:h-px after:w-0 hover:after:w-full after:end-0 hover:after:end-auto after:bottom-0 after:start-0 after:duration-500 hover:text-sky-600 after:bg-sky-600 duration-500 ease-in-out">
          Detalhes
          <i class="fa-solid fa-arrow-right"></i>
        </a>
      </div>
    </div>
  </div>
</template>
<script>

export default {
  name: 'ArticleCard',
  props: {
    item: {required: false, type: Object},
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
  },
  created: function () {
  },
}
</script>