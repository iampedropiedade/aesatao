import { createRouter, createWebHistory } from 'vue-router'

const router = createRouter({
  history: createWebHistory('/'),
  routes: [
    {
      path: '/:path',
      name: 'app',
      children: []
    },
  ]
})

export default router
