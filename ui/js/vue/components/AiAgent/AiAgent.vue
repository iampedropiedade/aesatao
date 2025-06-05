<template>
  <div class="flex flex-col text-gray-800 chat-assistant h-full" ref="container">
    <div class="flex flex-col h-full overflow-x-auto mb-4 bg-[#467498] bg-opacity-20 chatContainer" ref="chatContainer">
      <div class="flex flex-col h-full">
        <div class="grid grid-cols-12" v-for="(message, index) in aiAgentStore.messages" :key="index">
          <div class="col-start-6 col-end-13 p-4" v-if="message.query">
            <div class="flex align-top justify-start flex-row-reverse">
              <div class="flex items-center justify-center h-10 w-10 shadow-md rounded-full bg-[#87c2d7] bg-opacity-30 text-white flex-shrink-0">
                <span v-if="getInitials()" class="uppercase text-[1.2rem]">{{getInitials()}}</span>
                <i class="fa-solid fa-user" v-else></i>
              </div>
              <div class="relative mr-3 text-sm bg-[#87c2d7] bg-opacity-30 text-white py-2 px-4 shadow-md rounded-xl rounded-tr-none">
                <div v-text="message.query" class="text-[0.7rem] text-right"></div>
                <div class="!text-gray-200 text-[0.5rem] text-right">
                  {{ $dayjs(message.dateAsked).format('DD/MM/YYYY') }} às {{ $dayjs(message.dateAsked).format('HH:mm') }}
                </div>
              </div>
            </div>
          </div>
          <div class="col-start-1 col-end-8 p-4">
            <div class="flex flex-row align-top">
              <div
                  v-if="aiAgentStore.agent"
                  v-html="aiAgentStore.agent?.assistantSvg ? aiAgentStore.agent?.assistantSvg : aiAgentStore.agent?.assistantName"
                  class="flex items-center justify-center h-10 w-10 shadow-md rounded-full !bg-aesatao flex-shrink-0 p-2"></div>
              <div class="relative ml-3 text-sm bg-white py-2 px-4 shadow-md rounded-xl rounded-tl-none">
                <div v-html="message.response" v-if="!message.processing" class="text-[0.7rem]">
                </div>
                <thinking v-else></thinking>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="flex flex-row items-center h-12 w-full mt-2">
          <input
              ref="queryInput"
              type="text"
              :placeholder="aiAgentStore.agent?.queryPlaceholder"
              class="flex w-full border rounded-lg rounded-r-none focus:outline-none focus:border-indigo-300 pl-3 flex-grow h-full"
              v-model="aiAgentStore.query"
              :disabled="aiAgentStore.loading"
              v-on:keyup.enter="aiAgentStore.getAssistantResponse()"
          />
      <button
          v-on:click.prevent="aiAgentStore.getAssistantResponse()"
          :disabled="aiAgentStore.loading"
          class="flex items-center justify-center bg-aesatao bg-opacity-90 hover:bg-opacity-100 rounded-lg rounded-l-none text-white px-4 py-2 flex-shrink-0  h-full">
        <i class="fa-solid fa-paper-plane"></i>
      </button>
    </div>
    <div class="text-right text-gray-300 text-[0.6rem] mt-4">
      <button v-on:click.prevent="aiAgentStore.clearMessages()">
        Apagar histórico de mensagens
      </button>
    </div>
  </div>
</template>
<script>
import { useAiAgentStore } from "../../stores/ai_agent.js";
import { useAuthenticationStore } from "../../stores/authentication.js";
import Thinking from "./Chat/Thinking.vue";
import { mapState } from "pinia";

export default {
  name: 'AiAgent',
  props: {
    agentName: {required: false, type: String, default: ''},
    queryPlaceholder: {required: false, type: String, default: ''},
    queryButtonCaption: {required: false, type: String, default: ''},
    questions: {required: false, type: String, default: ''},
    thinking: {required: false, type: String, default: ''},
    assistantSvg: {required: false, type: String, default: ''},
  },
  components: {
    Thinking
  },
  computed: {
    ...mapState(useAiAgentStore, ["messages"]),
  },
  data() {
    return {
      isChatVisible: false,
      chatContainer: null,
      aiAgentStore: useAiAgentStore(),
      authenticationStore: useAuthenticationStore(),
    }
  },
  watch: {
    messages: {
      handler() {
        this.scrollToBottom()
        this.$refs.queryInput?.focus()
      },
      deep: true,
    },
  },
  methods: {
    getInitials() {
      return this.authenticationStore.userData?.firstname.charAt(0) + this.authenticationStore.userData?.lastname.charAt(0)
    },
    scrollToBottom() {
      this.$nextTick(() => {
        if (this.chatContainer) {
          this.chatContainer.scrollTop = this.chatContainer.scrollHeight;
        }
      });
    },
  },
  mounted: function () {
    this.chatContainer = this.$refs.chatContainer

    const observer = new IntersectionObserver(
        (entries) => {
          this.isChatVisible = entries[0].isIntersecting;
          if (this.isChatVisible) {
            this.scrollToBottom();
          }
        },
    );
    if (this.chatContainer) {
      observer.observe(this.chatContainer);
    }
  },
}
</script>