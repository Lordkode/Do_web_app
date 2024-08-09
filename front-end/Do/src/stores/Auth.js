import axios from '@/lib/axios'
import { defineStore } from 'pinia'

export const useUserStore = defineStore('userStore', {
  state: () => {
    return {
      user: null,
      users: null,
      errors: {},
      randomNum: 0,
      topics: [],
      member: null,
      error: null
    }
  },
  actions: {
    randomNumber() {
      this.randomNum = Math.floor(100000 + Math.random() * 900000)
    },

    async getUser() {
      if (localStorage.getItem('token')) {
        const res = await axios.get('/api/user').then((response) => {
          this.user = response.data
        })
      }
    },

    async getMember(id) {
      this.member = null
      try {
        this.member = await axios.get(`/api/users/${id}`).then((response) => response.data)
        return this.member.username
      } catch (error) {
        this.error = error
      }
    },

    async allUsers() {
      try {
        const response = await axios.get('/api/users')
        this.users = await response.data
      } catch (error) {
        console.log(error)
      }
    },

    async deleteUser(id) {
      try {
        const response = await axios.delete(`/api/users/${id}`)
        await this.allUsers()
      } catch (error) {
        console.log(error)
      }
    },

    async validateEmail() {
      // const response = await axios.post('/api/validateEmail')
    },

    async authentication(url, formData) {
      try {
        const response = await axios.post(`/api/${url}`, formData)
        const data = await response.data
        if (!data.errors) {
          this.errors = {}
          localStorage.setItem('token', data.token)
          localStorage.setItem('jsskshshddyeegshs', data.user.id)
          this.user = await data.user
          if (data.user.isAdmin == 1) {
            this.router.push({ name: 'dashboard' })
          } else this.router.push({ name: 'home' })
        }
      } catch (err) {
        this.errors = await err.validation
      }
    },

    async logout() {
      try {
        const res = await axios.post('/api/logout')
        this.user = null
        this.errors = {}
        localStorage.removeItem('token')
        localStorage.removeItem('jsskshshddyeegshs')
        this.router.push({ name: 'home' })
      } catch (err) {
        this.errors = await err.validation
      }
    }
  }
})
