<template>
  <div class="modal modal-fullscreen fade" id="ai-assistant-modal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered !w-[1/2] !max-w-[1/2]">
      <div class="modal-content h-[calc(100vh-8rem)]">
        <div class="modal-body bg-[#31546f] h-full image-wrapper bg-full bg-[url(../img/patterns/geo2.svg)] p-6 pt-12 rounded-xl">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
            <i class="fa-solid fa-xmark text-xl text-gray-300 hover:text-gray-200 p-1"></i>
          </button>
          <ai-agent />
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { useAiAgentStore } from "../../stores/ai_agent.js";
import AiAgent from "./AiAgent.vue";
export default {
  name: 'AiModal',
  props: {
  },
  components: {
    AiAgent
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