<template>
  <div class="card h-full">
    <figure class="card-img-top overlay overlay-1 hover-scale group">
      <a class="!text-aesatao-700 hover:!text-aesatao-700" :href="item.url">
        <img class="!transition-all !duration-[0.35s] !ease-in-out group-hover:scale-105" :src="item.thumbnailUrl" alt="image" v-if="item.thumbnailUrl">
        <span class="bg"></span>
      </a>
      <figcaption class="group-hover:opacity-100 absolute w-full h-full opacity-0 text-center px-4 py-3 inset-0 z-[5] pointer-events-none p-2">
        <h5 class="from-top  !mb-0 absolute w-full translate-y-[-80%] p-[.75rem_1rem] left-0 top-2/4">
          Ler mais
        </h5>
      </figcaption>
    </figure>
    <div class="card-body flex-[1_1_auto] p-[40px] xl:!p-[2rem_2.5rem_1.25rem] lg:!p-[2rem_2.5rem_1.25rem] md:!p-[2rem_2.5rem_1.25rem] max-md:pb-4  ">
      <div class="post-header !mb-[.9rem]">
        <div
            v-if="item.tags"
            class="inline-flex !mb-[.4rem] uppercase !tracking-[0.02rem] text-[0.7rem] font-bold !text-[#aab0bc] relative align-top !pl-[1.4rem] before:content-[''] before:absolute before:inline-block before:translate-y-[-60%] before:w-3 before:h-[0.05rem] before:left-0 before:top-2/4 before:bg-aesatao-700">
          <button class="hover" rel="category" v-for="(tag) in item.tags" v-on:click="filterByTag(tag)">{{ tag.tag }}</button>
        </div>
        <h3 class="post-title !mt-1 !leading-[1.35] !mb-0">
          <a class="!text-aesatao-800 hover:!text-aesatao-600" :href="item.url">{{ item.title }}</a>
        </h3>
      </div>
      <div class="!relative">
        {{ item.description }}
      </div>
    </div>
    <div class="card-footer xl:!p-[1.25rem_2.5rem_1.25rem] lg:!p-[1.25rem_2.5rem_1.25rem] md:!p-[1.25rem_2.5rem_1.25rem] p-[18px_40px] !border-0">
      <div class="text-[0.7rem] text-aesataoGrey-400 text-right ">{{ $dayjs(item.date.date).fromNow() }}</div>
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