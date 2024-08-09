import { defineStore } from 'pinia'

export const useAnimationStore = defineStore('animationStore', {
  state: () => {
    return {
      dialog: false
    }
  },
  actions: {
    activeDialog() {
      this.dialog = true
    },
    desactiveDialog() {
      this.dialog = false
    }
  }
})
