<template>
  <div>
    <div class="contact-form needs-validation">
      <div class="flex mb-4 items-center">
        <div class="w-full flex-grow-1">
          <div class="form-floating relative !mb-4">
            <input
                id="query"
                type="text"
                name="query"
                class="form-control relative block w-full !pb-6 !pt-9 text-[.85rem] font-medium !text-[#60697b] bg-[#fefefe] bg-clip-padding border shadow-[0_0_1.25rem_rgba(30,34,40,0.04)] rounded-[0.4rem] border-solid border-[rgba(8,60,130,0.07)] transition-[border-color] duration-[0.15s] ease-in-out focus:shadow-[0_0_1.25rem_rgba(30,34,40,0.04),unset]   focus-visible:!border-[rgba(63,120,224,0.5)] placeholder:!text-[#959ca9] placeholder:opacity-100 m-0 !pr-9 p-[.6rem_1rem] h-[calc(2.5rem_+_2px)] min-h-[calc(2.5rem_+_2px)] !leading-[1.25]"
                placeholder=""
                required=""
                v-model="query"
                v-on:keydown.enter="load()"
            >
            <label for="query" class="!text-[#959ca9] !mb-2 !inline-block text-[.75rem] !absolute !z-[2] h-full overflow-hidden text-start text-ellipsis whitespace-nowrap pointer-events-none border origin-[0_0] px-4 py-[1rem] border-solid border-transparent left-0 top-0 font-Manrope">
              Termos de pesquisa
            </label>
          </div>
        </div>
        <div class="ml-2">
          <div class="form-floating relative">
            <button
                type="button"
                class="btn btn-primary !p-4 !text-white !bg-[#3f78e0] border-[#3f78e0] hover:text-white hover:bg-[#3f78e0] hover:!border-[#3f78e0]   active:text-white active:bg-[#3f78e0] active:border-[#3f78e0] disabled:text-white disabled:bg-[#3f78e0] disabled:border-[#3f78e0] !rounded-[50rem] btn-send !mb-3 hover:translate-y-[-0.15rem] hover:shadow-[0_0.25rem_0.75rem_rgba(30,34,40,0.15)]"
                v-on:click="load()"
            >
              <i class="fa-solid fa-magnifying-glass !text-[1.1rem]"></i>
            </button>
          </div>
        </div>
      </div>
    </div>

    <div>
      <div class="tab-content !mt-0 md:!mt-5">
          <div class="flex flex-wrap mx-[-15px] !mt-[-30px]">
            <div class="md:w-6/12 lg:w-4/12 xl:w-4/12 w-full flex-[0_0_auto] !px-[15px] max-w-full !mt-[30px] group"  v-for="entry in results">
              <a :href="entry.url" class="card !shadow-[0_0.25rem_1.75rem_rgba(30,34,40,0.07)] lift !h-full">
                <div class="card-body p-6 flex flex-row">
                  <div class="flex-grow-1">
                    <h4 class="!mb-1 break-words whitespace-normal overflow-hidden text-wrap group-hover:underline" v-html="highlight(entry.title)"></h4>
                    <div class="!mb-1 break-words whitespace-normal overflow-hidden text-wrap group-hover:underline" v-html="highlight(entry.description)"></div>
                    <div class="!mb-0 !text-gray-500 text-[0.7rem]">Modificado {{ $dayjs(entry.dateModified.date).fromNow() }}</div>
                  </div>
                </div>
              </a>
            </div>
          </div>
        </div>
    </div>

    <div class="flex flex-wrap mx-[-15px] !mt-[3rem]" v-if="pagination.hasNextPage">
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
  name: 'FuzzySearch',
  props: {
    apiUrl: {required: true, type: String},
    allowedSearchDomains: {required: true},
    originalQuery: {required: false, type: String, default: ''},
  },
  components: {
  },
  data() {
    return {
      loading: false,
      query: this.originalQuery,
      searchDomains: [],
      results: [],
      pagination: {},
    }
  },
  methods: {
    highlight(text) {
      const regex = new RegExp(`(${this.query})`, "gi");
      return text.replace(regex, '<span class="bg-[#f7e837] bg-opacity-75">$1</span>')
    },
    reset() {
      this.results = []
      this.load()
      this.$router.replace({path: this.$router.path, query: {}})
    },
    async load() {
      axios
          .get(this.apiUrl + '?query=' + this.query + '&searchDomains=' + JSON.stringify(this.searchDomains))
          .then(response => {
            let responseData = response.data
            this.results = responseData.items
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
    this.searchDomains = this.allowedSearchDomains
    if(this.query) {
      this.load()
    }
  },
}
</script>