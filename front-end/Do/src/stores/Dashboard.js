import axios from '@/lib/axios'
import { defineStore } from 'pinia'

export const useKpiStore = defineStore('kpiStore', {
  state: () => {
    return {
      users7Day: 0,
      post7Days: 0,
      commentByday: 0,
      totalUsers: 0,
      totalTopics: 0
    }
  },
  actions: {
    async user7Days() {
      try {
        const response = await axios.get('/api/kpi1')
        this.post7Days = await response.data.Commentlast7days
        this.totalUsers = await response.data.TotalUser
        this.users7Day = await response.data.Userlast7days
        this.totalTopics = await response.data.TotalTopic
      } catch (error) {
        console.log(error)
      }
    }
  }
})
