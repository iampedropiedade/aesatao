<template>
  <li class="nav-item" v-if="this.authenticationStore.userData">
    <a class="!w-[42px] !h-[42px] !p-[0.4rem_0.3rem] btn btn-sm btn-aqua !text-white !border-0 !bg-opacity-70 !bg-aesatao-600 !border-aesatao-600 hover:text-white hover:bg-aesatao-600 hover:!border-aesatao-600 active:text-white active:bg-aesatao-600 active:border-aesatao-600 disabled:text-white disabled:bg-aesatao-600 disabled:border-aesatao-600 !rounded-full"
       :title="getTitle()"
       :href="getUrl()">
      <i :class="getIcon()"></i>
    </a>
  </li>
  <li class="nav-item" v-else>
    <a class="!w-[42px] !h-[42px] !p-[0.4rem_0.3rem] btn btn-sm btn-aqua !text-white !border-0 !bg-opacity-70 !bg-aesatao-600 !border-aesatao-600 hover:text-white hover:bg-aesatao-600 hover:!border-aesatao-600 active:text-white active:bg-aesatao -700 active:border-aesatao-600 disabled:text-white disabled:bg-aesatao-600 disabled:border-aesatao-600 !rounded-full"
       :title="getTitle()"
       :href="getUrl()">
      <i :class="getIcon()"></i>
    </a>
  </li>
</template>
<script>
import { useAuthenticationStore } from "../../stores/authentication.js";

export default {
  name: 'NavAuthentication',
  props: {
    images: {required: false, type: Array},
  },
  data() {
    return {
      authenticationStore: useAuthenticationStore(),
      currentImage: '',
      currentIndex: 0
    }
  },
  methods: {
    getIcon() {
      return 'fa-solid m-1 !text-[0.6rem] md:!text-[0.65rem] lg:!text-[0.8rem] ' + (this.authenticationStore.userData?.logoutUrl ? 'fa-lock-open' : 'fa-lock')
    },
    getUrl() {
      return this.authenticationStore.userData?.logoutUrl ? this.authenticationStore.userData.logoutUrl : '/ccm/system/authentication/oauth2/google/attempt_auth'
    },
    getTitle() {
      return this.authenticationStore.userData?.logoutUrl ? 'Logout' : 'Login'
    },
    async load() {
      await this.authenticationStore.loadUser()
    }
  },
  created: function () {
    this.load()
  },
}
</script>