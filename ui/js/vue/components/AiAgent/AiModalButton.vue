<template>
  <li class="nav-item">
    <button
        data-bs-toggle="modal"
        data-bs-target="#ai-assistant-modal"
        v-html="aiAgentStore.agent?.assistantSvg"
        class="!w-[42px] !h-[42px] !p-2 btn btn-sm btn-aqua !text-white !border-0 !bg-opacity-70 !bg-aesatao !border-aesatao hover:text-white hover:bg-aesatao hover:!border-aesatao focus:shadow-[rgba(79,152,181,1)] active:text-white active:bg-aesatao active:border-aesatao disabled:text-white disabled:bg-aesatao disabled:border-aesatao !rounded-full">
    </button>
  </li>
</template>
<script>
import { useAiAgentStore } from "../../stores/ai_agent.js";

export default {
  name: 'AiModalButton',
  props: {
    images: {required: false, type: Array},
  },
  data() {
    return {
      aiAgentStore: useAiAgentStore(),
    }
  },
  methods: {
  },
  created: function () {
    this.aiAgentStore.initAgent()
  },
}
</script>