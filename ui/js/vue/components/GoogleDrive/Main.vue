<template>
  <div>
    <div class="flex flex-wrap mx-[-15px] !text-center">
      <div class="xl:w-10/12 w-full flex-[0_0_auto] px-[15px] max-w-full !mx-auto">
        <h2 class="!text-[.75rem] uppercase text-royalBlue tracking-[0.02rem] leading-[1.35] !mb-3" v-if="subTitle">
          {{ subTitle }}
        </h2>
        <h3 class="text-[calc(1.305rem_+_0.66vw)] font-bold xl:text-[1.8rem] !leading-[1.3] mb-10 xxl:!px-20" v-if="title">
          {{ title }}
        </h3>
      </div>
    </div>

    <div class="mb-8 flex w-full">
      <div class="flex-grow me-2">
          <span>
            <span class="px-1 underline cursor-pointer" v-on:click="reset()"><i class="fa-solid fa-house"></i></span>
            <span class="px-1" v-if="currentParents.length > 0">/</span>
          </span>
          <span v-for="(item, index) in currentParents" :key="index">
            <span class="underline cursor-pointer" v-on:click="backToParent(item)">
              {{ item.title }}
            </span>
            <span class="px-1" v-if="index !== currentParents.length - 1">/</span>
          </span>
      </div>
      <div class="me-2">
        <button
            class="btn btn-outline !p-2"
            v-on:click="itemStyle = 'list'"
            :class="itemStyle === 'list' ? '!bg-gray-900 !border-gray-900 !text-gray-100' : '!bg-gray-100 !border-gray-100 !text-gray-500'"
            :disabled="itemStyle === 'list'">
          <i class="fa-solid fa-grip-lines"></i>
        </button>
      </div>
      <div>
        <button
            class="btn btn-outline !p-2 !border-gray-400 !text-gray-400'"
            v-on:click="itemStyle = 'grid'"
            :class="itemStyle === 'grid' ? '!bg-gray-900 !border-gray-900 !text-gray-100' : '!bg-gray-100 !border-gray-100 !text-gray-500'"
            :disabled="itemStyle === 'grid'">
          <i class="fa-solid fa-grip"></i>
        </button>
      </div>
    </div>

    <div ref="fileListContainer">
      <div class="flex flex-wrap p-32 text-center align items-center justify-center" v-if="loading">
        <i class="fa-solid fa-circle-notch fa-spin text-[3rem] text-aesatao"></i>
      </div>
      <div v-else>
        <div v-if="items.length === 0" class="">
          <h5 class="text-gray-600 font-light">Não existem items na pasta selecionada.</h5>
        </div>
        <div v-else>
          <div class="flex flex-wrap mx-[-15px] !mt-[-30px]" v-if="itemStyle === 'grid'">
            <div class="md:w-6/12 lg:w-4/12 xl:w-4/12 w-full flex-[0_0_auto] !px-[15px] max-w-full !mt-[30px] group cursor-pointer" v-for="(item, index) in items" :key="index" v-on:click="openItem(item)">
              <div class="card !shadow-[0_0.25rem_1.75rem_rgba(30,34,40,0.07)] lift !h-full">
                <div class="card-body p-3 flex flex-row">
                  <div>
                    <span class=" flex items-center justify-center font-bold !leading-[1.7] !tracking-[-0.01rem] rounded-[100%] bg-[#7fbf35] opacity-100 !text-white !w-[2.5rem] !h-[2.5rem] text-[0.9rem] !mr-4">
                      <i :class="item.icon"></i>
                    </span>
                  </div>
                  <div class="flex-grow-1">
                    <span class="badge bg-[#e0e9fa] !text-[#3f78e0] rounded py-1 !mb-2" v-if="item.size">{{ item.sizeFormatted }}</span>
                    <h4 class="!mb-1 break-words whitespace-normal overflow-hidden text-wrap group-hover:underline">{{ item.title }}</h4>
                    <div class="!mb-0 !text-gray-500 text-[0.7rem]">Modificado em {{ $dayjs(item.dateModified).fromNow() }}</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div v-else>
            <table class="w-full">
              <tr class="border-b group hover:bg-gray-50 cursor-pointer" v-for="(item, index) in items" :key="index"  v-on:click="openItem(item)">
                <td class="py-2">
                  <div class="flex flex-row w-full group-hover:underline">
                    <span class=" flex items-center justify-center font-bold !leading-[1.7] !tracking-[-0.01rem] rounded-[100%] bg-[#7fbf35] opacity-100 !text-white !w-[1.5rem] !h-[1.5rem] text-[0.7rem] !mr-2">
                      <i :class="item.icon"></i>
                    </span>
                    <h4 class="flex-grow-1 !mb-1 break-words whitespace-normal overflow-hidden text-wrap text-[0.8rem]">{{ item.title }}</h4>
                  </div>
                </td>
                <td class="py-2">
                  <span class="badge bg-[#e0e9fa] !text-[#3f78e0] rounded py-1 !mb-2" v-if="item.size">{{ item.sizeFormatted }}</span>
                </td>
                <td class="py-2 text-right !text-gray-500 text-[0.7rem]">
                  Modificado em {{ $dayjs(item.dateModified).fromNow() }}
                </td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>

    <div class="flex flex-wrap mx-[-15px] !mt-[3rem]" v-if="displayPagination === 'display' && nextPageToken">
      <div class="lg:w-6/12 xl:w-5/12 w-full flex-[0_0_auto] px-[15px] max-w-full !mx-auto !text-center">
        <button v-on:click="load()" :disabled="loading" class="btn btn-primary text-white !bg-royalBlue border-royalBlue hover:text-white hover:bg-royalBlue hover:border-royalBlue focus:shadow-[rgba(92,140,229,1)] active:text-white active:bg-royalBlue active:border-royalBlue disabled:!bg-slate-400 disabled:!text-slate-300 disabled:border-slate-200 !rounded-[50rem] hover:translate-y-[-0.15rem] hover:shadow-[0_0.25rem_0.75rem_rgba(30,34,40,0.15)]">
          Mais resultados
        </button>
      </div>
    </div>
  </div>
</template>
<script>
import axios from 'axios'

export default {
  name: 'GoogleDrive',
  props: {
    title: {required: false, type: String, default: ''},
    subTitle: {required: false, type: String, default: ''},
    parentFolderId: {required: false, type: String, default: ''},
    displayItemTypes: {required: false, type: String, default: 'all'},
    displayPermissions: {required: false, type: String, default: 'public'},
    openFoldersMethod: {required: false, type: String, default: 'site'},
    defaultItemStyle: {required: false, type: String, default: 'list'},
    orderBy: {required: false, type: String, default: 'name'},
    apiUrl: {required: false, type: String, default: '/api/google/drive'},
    itemsPerPage: {required: false, type: Number, default: 9},
    displayPagination: {required: false, type: Boolean, default: false},
  },
  components: {
  },
  data() {
    return {
      loading: false,
      itemStyle: this.defaultItemStyle,
      items: [],
      nextPageToken: null,
      currentParents: [],
      queryParams: {
        itemsPerPage: this.itemsPerPage,
        page: 1,
      },
      test: {},
    }
  },
  methods: {
    scrollToBottom() {
      if (this.$refs.value) {
        this.$refs.value.scrollTop = this.$refs.value.scrollHeight;
      }
    },
    reset() {
      this.items = []
      this.currentParents = []
      this.pagination = {}
      this.queryParams.parentFolderId = this.parentFolderId
      this.load(false)
    },
    isChildFolder() {
      return this.queryParams.parentFolderId !== this.parentFolderId
    },
    openItem(item) {
      if (item.folder === false || (item.folder === true && this.openFoldersMethod === 'drive')) {
        window.open(item.viewLink, '_blank');
        return
      }
      this.currentParents.push(item)
      this.queryParams.parentFolderId = item.id
      this.nextPageToken = null
      this.pagination = {}
      this.load(false)
    },
    backToParent(item) {
      let newParents = []
      for(let index = 0; index < this.currentParents.length; index++) {
        newParents.unshift(this.currentParents[index])
        if(this.currentParents[index].id === item.id) {
          break;
        }
      }
      this.currentParents = newParents
      const currentParent = this.currentParents.slice(-1).pop()
      this.queryParams.parentFolderId = currentParent?.id
      this.nextPageToken = null
      this.load(false)
    },
    async load(append = true) {
      if (append === false) {
        this.loading = true
      }
      this.queryParams.displayPermissions = this.displayPermissions
      this.queryParams.displayItemTypes = this.displayItemTypes
      this.queryParams.itemsPerPage = this.itemsPerPage;
      this.queryParams.displayItemTypes = this.displayItemTypes
      this.queryParams.nextPageToken = this.nextPageToken
      this.queryParams.orderBy = this.orderBy
      let query = new URLSearchParams(this.queryParams)
      let queryString = query.toString()
      let url = this.apiUrl + '?' + queryString

      axios
          .get(url)
          .then(response => {
            let responseData = response.data
            if(append) {
              this.items = [...this.items, ...responseData.items]
            } else {
              this.items = responseData.items ?? []
            }
            this.nextPageToken = responseData.nextPageToken
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
    this.queryParams.parentFolderId = this.parentFolderId
    this.load()
  },
}
</script>