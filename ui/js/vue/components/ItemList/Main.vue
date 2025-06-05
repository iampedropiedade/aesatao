<template>
  <div>
    <div v-if="cardStyle === 'horizontal'" class="grid md:grid-cols-12 grid-cols-1 pb-8 items-end">
      <div class="lg:col-span-8 md:col-span-6 md:text-start text-center">
        <h2 class="mb-4 md:text-3xl md:leading-normal text-2xl leading-normal font-semibold">
          {{ title }}
        </h2>
        <div class="text-slate-500 max-w-xl">
          {{ subTitle }}
        </div>
      </div>
      <div class="lg:col-span-4 md:col-span-6 md:text-end hidden md:block" v-if="ctaCaption && ctaLinkToPageUrl">
        <a :href="ctaLinkToPageUrl" class="relative inline-block font-semibold tracking-wide align-middle text-base text-center border-none after:content-[''] after:absolute after:h-px after:w-0 hover:after:w-full after:end-0 hover:after:end-auto after:bottom-0 after:start-0 after:duration-500 text-sky-600 hover:text-sky-600 after:bg-sky-600 duration-500 ease-in-out">
          {{ ctaCaption }} <i class="fa-solid fa-arrow-right"></i>
        </a>
      </div>
    </div>
    <div v-else-if="title || subTitle" class="flex flex-wrap mx-[-15px] !text-center" >
      <div class="!mx-auto text-center my-12">
        <h1 class="!text-[calc(1.365rem_+_1.38vw)] font-bold xl:!text-[2.4rem] !mb-3" v-if="title">
          {{ title }}
        </h1>
        <p class="lead lg:!px-[1.25rem] xl:!px-[1.25rem] xxl:!px-[2rem] text-[0.9rem] font-medium !mb-[.25rem]" v-if="subTitle">
          {{ subTitle }}
        </p>
      </div>
    </div>

    <div class="mb-6" v-if="Object.keys(originalFilters.tagsIn).length === 0 && filters.tagsIn && Object.keys(filters.tagsIn).length > 0">
      <div class="card !shadow-[0_0.25rem_1.75rem_rgba(30,34,40,0.07)]">
        <div class="card-body p-8">
          <div class="flex lg:block xl:flex flex-row">
            <div class="flex w-full">
              <h3 class="!mb-0 text-[1rem] !mr-4">
                Filtros
              </h3>
              <div class="grow">
                <span class="badge bg-brightGray !text-royalBlue rounded py-1 mr-2" v-for="(tag) in filters.tagsIn">{{ tag.tag }}</span>
              </div>
              <button v-on:click="resetFilters()" class="icon btn btn-circle btn-primary text-white !bg-[#467498] border-[#467498] hover:text-white hover:bg-[#467498] hover:border-[#467498] focus:shadow-[rgba(92,140,229,1)] active:text-white active:bg-[#467498] active:border-[#467498] disabled:text-white disabled:bg-[#467498] disabled:border-[#467498] !w-[1.5rem] !h-[1.5rem] !inline-flex !items-center !justify-center !text-[1rem] !leading-none !p-0 !rounded-full">
                <i class="fa-solid fa-xmark text-[1rem] leading-none"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="grid grid-cols-1 gap-4 items-stretch" :class="{'lg:grid-cols-2': cardStyle === 'horizontal', 'md:grid-cols-2 lg:grid-cols-3': cardStyle !== 'horizontal'}">
      <div class="w-full h-full" v-for="(item, index) in items">
        <article-card :item="item" v-if="cardStyle === 'article'" v-on:filter-by-tag="handleFilterByTag($event)"></article-card>
        <horizontal-card :item="item" v-else-if="cardStyle === 'horizontal'" :card-style="cardStyle"></horizontal-card>
        <file-card :item="item" v-else-if="cardStyle === 'file'"></file-card>
        <page-card :item="item" v-else v-on:filter-by-tag="handleFilterByTag($event)" :card-style="cardStyle"></page-card>
      </div>
    </div>

    <div class="flex flex-wrap mx-[-15px] !mt-[3rem]" v-if="displayPagination === 'display' && pagination.hasNextPage">
      <div class="lg:w-6/12 xl:w-5/12 w-full flex-[0_0_auto] px-[15px] max-w-full !mx-auto !text-center">
        <button v-on:click="load()" :disabled="loading" class="btn btn-primary text-white !bg-royalBlue border-royalBlue hover:text-white hover:bg-royalBlue hover:border-royalBlue focus:shadow-[rgba(92,140,229,1)] active:text-white active:bg-royalBlue active:border-royalBlue disabled:!bg-slate-400 disabled:!text-slate-300 disabled:border-slate-200 !rounded-[50rem] hover:translate-y-[-0.15rem] hover:shadow-[0_0.25rem_0.75rem_rgba(30,34,40,0.15)]">
          Mais resultados
        </button>
      </div>
    </div>

    <div class="flex flex-wrap mx-[-15px] !mt-[3rem]" v-if="ctaCaption && ctaLinkToPageUrl">
      <div class="lg:w-6/12 xl:w-5/12 w-full flex-[0_0_auto] px-[15px] max-w-full !mx-auto !text-center">
        <a :href="ctaLinkToPageUrl"
           class="btn !bg-aesataoAlt-600 !text-white btn-md !rounded-[50rem] flex items-center hover:translate-y-[-0.15rem] hover:shadow-[0_0.25rem_0.75rem_rgba(30,34,40,.05)]">
          {{ ctaCaption }}
        </a>
      </div>
    </div>
  </div>
</template>
<script>
import PageCard from './Page.vue'
import ArticleCard from './Article.vue'
import FileCard from './File.vue'
import HorizontalCard from './Horizontal.vue'
import axios from 'axios'

export default {
  name: 'ItemList',
  props: {
    title: {required: false, type: String, default: ''},
    subTitle: {required: false, type: String, default: ''},
    ctaCaption: {required: false, type: String, default: ''},
    ctaLinkToPageUrl: {required: false, type: String, default: ''},
    itemsPerPage: {required: false, type: Number, default: 3},
    displayPagination: {required: false, type: String, default: 'hide'},
    cardStyle: {required: false, type: String, default: 'page'},
    apiUrl: {required: false, type: String, default: '/api/pages'},
    apiType: {required: false, type: String, default: 'pages'},
    currentUrl: {required: false, type: String, default: '/'},
    filtersJson: {required: false, type: String},
    sort: {required: false, type: String},
  },
  components: {
    PageCard,
    ArticleCard,
    HorizontalCard,
    FileCard
  },
  data() {
    return {
      loading: false,
      items: [],
      pagination: {},
      filters: {},
      originalFilters: {},
      queryParams: {
        itemsPerPage: this.itemsPerPage,
        page: 1,
      },
    }
  },
  methods: {
    setParams() {
      this.originalFilters = this.filtersJson ? JSON.parse(this.filtersJson) : {}
      this.filters = this.filtersJson ? JSON.parse(this.filtersJson) : {}
    },
    resetFilters() {
      this.items = []
      this.filters = this.filtersJson ? JSON.parse(this.filtersJson) : {}
      this.pagination = {}
      this.load()
      // this.$router.replace({path: this.$router.path, query: {}})
    },
    handleFilterByTag(tag) {
      this.items = []
      this.filters.tagsIn = [tag.id]
      this.pagination = {}
      this.load()
      // this.$router.replace({path: this.$router.path, query: {filters: JSON.stringify(this.filters)}})
    },
    async load() {
      if(this.pagination.hasNextPage !== undefined && this.pagination.hasNextPage !== true) {
        return;
      }
      this.loading = true
      this.queryParams.filters = JSON.stringify(this.filters);
      this.queryParams.sort = this.sort;
      this.queryParams.page = this.pagination.nextPage ? this.pagination.nextPage : 1
      let query = new URLSearchParams(this.queryParams)
      let queryString = query.toString()
      let url = this.apiUrl + '?' + queryString

      axios
          .get(url)
          .then(response => {
            let responseData = response.data
            this.items = [...this.items, ...responseData.items]
            this.pagination = responseData.pagination
          })
          .catch(errors => {
            console.error(errors)
          })
          .finally(() => {
            this.loading = false
          })

    },
  },
  created: function () {
    this.setParams()
    this.load()
  },
}
</script>