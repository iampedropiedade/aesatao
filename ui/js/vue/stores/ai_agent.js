import { defineStore } from 'pinia'
import {marked} from "marked";
import { useStorage } from '@vueuse/core'

export const useAiAgentStore = defineStore('ai_agent', {
    state: () => ({
        threadId: useStorage('ai_agent.thread_id', null),
        messages: useStorage('ai_agent.messages', []),
        agent: null,
        agentName: '',
        agentSvg: '',
        agentWelcomeMessage: '',
        queryPlaceholder: '',
        loading: false,
        query: '',
        error: '',
    }),
    actions: {
        async initAgent() {
            if(this.agent !== null) {
                return;
            }
            try {
                this.loading = true;
                const response = await fetch("/api/ai-agent", {
                    method: "GET",
                    headers: { "Content-Type": "application/json" },
                });
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                this.agent = await response.json();
            } catch (error) {
                console.error("Error getting agent:", error);
            } finally {
                this.loading = false;
            }
        },
        async createThread() {
            try {
                this.loading = true;
                const response = await fetch("/api/ai-agent/threads", {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                });
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                const data = await response.json();
                this.threadId = data.threadId;
            } catch (error) {
                console.error("Error creating thread:", error);
                this.error = 'Houve um erro a obter uma resposta do ' + this.agent?.assistantName + '. Por favor tenta novamente mais tarde.';
            } finally {
                this.loading = false;
            }
        },
        clearMessages() {
            this.messages = []
            const welcomeMessage = {
                query: null,
                dateAsked: null,
                processing: false,
                response: this.agent?.assistantWelcomeMessage
            };
            this.messages.push(welcomeMessage)
        },
        saveMessage(response) {
            let message = this.messages.at(-1)
            if(message.processing === true) {
                message.response = marked.parse(response.content[0].text.value)
                message.processing = false
            }
            this.loading = false
            this.messages.slice(50)
        },
        async getAssistantResponse() {
            const controller = new AbortController();
            const timeoutId = setTimeout(() => controller.abort(), 20000);
            try {
                if(this.threadId === null) {
                    await this.createThread()
                }
                this.error = undefined
                this.loading = true
                let postBody = {
                    threadId: this.threadId,
                    query: this.query
                }
                const currentMessage = {
                    query: this.query,
                    dateAsked: new Date(),
                    processing: true,
                    response: ''
                };
                this.query = ''
                this.messages.push(currentMessage)
                const response = await fetch("/api/ai-agent/threads/message", {
                    method: "POST",
                    headers: {"Content-Type": "application/json"},
                    body: JSON.stringify(postBody),
                });
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                const reader = response.body.getReader();
                const decoder = new TextDecoder();
                this.response = '';

                while (true) {
                    const {done, value} = await reader.read();
                    if (done) {
                        break;
                    }
                    const chunk = decoder.decode(value, { stream: true });
                    try {
                        const responseData = JSON.parse(chunk);
                        if (responseData.event === 'thread.message.delta') {
                            this.loading = false
                            this.currentQuery = this.query
                            this.response = this.response + responseData.response.delta.content[0].text.value;
                        } else if (responseData.event === "thread.message.completed") {
                            this.saveMessage(responseData.response)
                        }
                    } catch (e) {
                        console.warn("Failed to parse response chunk:", chunk);
                    }
                }
            } catch (error) {
                console.error("Error fetching assistant response:", error);
                this.saveMessage('Houve um erro a obter uma resposta do ' + this.agentName + '. Por favor tenta novamente mais tarde.')
            }
            finally {
                clearTimeout(timeoutId);
            }
        },
    },
})
