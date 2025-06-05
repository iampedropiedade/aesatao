import { defineStore } from 'pinia'

export const useAuthenticationStore = defineStore('authentication', {
    state: () => ({
        userData: null,
        loading: false,
    }),
    actions: {
        async loadUser() {
            if(this.userData !== null || this.loading === true) {
                return
            }
            this.loading = true
            try {
                const response = await fetch('/api/user')
                if (!response.ok) {
                    throw new Error(`Response status: ${response.status}`)
                }
                this.userData = await response.json()
            } catch (error) {
                console.error(error.message)
            } finally {
                this.loading = false
            }
        },
    },
})
