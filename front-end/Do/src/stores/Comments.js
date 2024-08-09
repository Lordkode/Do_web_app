import axios from '@/lib/axios'
import { defineStore, acceptHMRUpdate } from 'pinia'

export const useCommentStore = defineStore('commentStore', {
  state: () => {
    return {
      comments: [],
      comment: null,
      error: null,
      loading: null,
      numberOfComments: null,
      noteSum: 0,
      commentsByUser: [],
      nomberOfCommentsByUser: 0
    }
  },
  getters: {
    doublePlusOne() {
      let sum = 0
      this.comments.forEach((element) => {
        sum += parseInt(element.note) / this.numberOfComments
      })
      this.noteSum = Math.floor(sum * 10) / 10
      return this.noteSum
    }
  },
  actions: {
    async fetchComments(id) {
      this.loading = true
      this.comments = []
      try {
        await axios
          .get('/api/comments')
          .then((response) => response.data)
          .then((datas) => {
            datas.filter((data) => {
              if (data.topic_id === id) {
                this.comments.push(data)
                this.numberOfComments = this.comments.length
              }
            })
          })
      } catch (error) {
        this.error = error
      } finally {
        this.loading = false
      }
    },
    async fecthCommentsByUser(id) {
      this.loading = true
      this.commentsByUser = []
      try {
        await axios
          .get('/api/comments')
          .then((response) => response.data)
          .then((datas) => {
            datas.filter((data) => {
              if (data.user_id === id) {
                this.commentsByUser.push(data)
                this.nomberOfCommentsByUser = this.commentsByUser.length
              }
            })
          })
      } catch (error) {
        this.error = error
      } finally {
        this.loading = false
      }
    },
    async fetchComment(id) {
      this.loading = true
      this.comment = null

      try {
        this.comment = await axios.get(`/api/comments/${id}`).then((response) => response.data)
      } catch (error) {
        this.error = error
      } finally {
        this.loading = false
      }
    },
    async addComment(data) {
      this.comment = null
      try {
        this.comment = await axios.post('/api/comments', data).then((response) => response.data)
        return this.comment.id
      } catch (error) {
        this.error = error
      }
    }
  }
})

if (import.meta.hot) {
  import.meta.hot.accept(acceptHMRUpdate(useCommentStore, import.meta.hot))
}
