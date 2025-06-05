<template>
  <div class="card !shadow-[0_0.25rem_1.75rem_rgba(30,34,40,0.07)] lift !h-full">
    <div class="card-body p-5 flex flex-col h-full">
      <div class="flex mb-4">
        <div class="grow flex" v-if="(item.tags !== undefined) && (item.tags.length > 0)">
          <div class="badge bg-brightGray !text-royalBlue rounded py-1 mb-2 mr-2" v-for="(tag) in item.tags">{{ tag }}</div>
        </div>
        <div>
          <i class="fa-solid fa-file-pdf"></i>
        </div>
      </div>
      <a :href="item.url" class="grow" target="_blank">
        <div class="flex !mb-4">
          <h4>{{ item.title }}</h4>
        </div>
        <div class="mb-4 text-darkElectricBlue grow">{{ item.description }}</div>
      </a>
      <div class="inline-block text-[0.65rem]">
        <i class="fa-regular fa-calendar pr-2"></i>
        Publicado
        <span>{{ $dayjs(item.date.date).fromNow() }}</span>
      </div>
    </div>
  </div>
</template>
<script>

export default {
  name: 'FileCard',
  props: {
    item: {required: false, type: Object},
  },
  data() {
    return {
    }
  },
  methods: {
    load() {
    },
  },
  created: function () {
  },
}
</script>