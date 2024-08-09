import axios from '@/lib/axios'
import { defineStore, acceptHMRUpdate } from 'pinia'

export const useTopicStore = defineStore('topicStore', {
  state: () => {
    return {
      topics: [],
      topic: null,
      error: null,
      loading: null,
      userTopics: [],
      numberOfTopicsByUser: 0
    }
  },
  actions: {
    async fetchTopics() {
      this.loading = true
      this.topics = []

      try {
        this.topics = await axios.get('/api/topics').then((response) => response.data)
      } catch (error) {
        this.error = error
      } finally {
        this.loading = false
      }
    },
    async fetchTopicsByUser(id) {
      this.loading = true
      this.userTopics = []
      try {
        await axios
          .get('/api/topics')
          .then((response) => response.data)
          .then((datas) => {
            datas.filter((data) => {
              if (data.user_id === id) {
                this.userTopics.push(data)
                this.numberOfTopicsByUser = this.userTopics.length
              }
            })
          })
      } catch (error) {
        this.error = error
      } finally {
        this.loading = false
      }
    },

    async fetchTopic(id) {
      this.topic = null
      this.loading = true

      try {
        this.topic = await axios.get(`/api/topics/${id}`).then((response) => response.data)
      } catch (error) {
        this.error = error
      } finally {
        this.loading = false
      }
    },
    async addTopic(data) {
      this.topic = null
      try {
        this.topic = await axios.post('/api/topics', data).then((response) => response.data)
        return this.topic.id
      } catch (error) {
        this.error = error
      }
    }
  }
})

if (import.meta.hot) {
  import.meta.hot.accept(acceptHMRUpdate(useTopicStore, import.meta.hot))
}
