<template>
  <div class="flex justify-between w-full h-16 items-center">
    <h1 class="text-4xl font-black text-[#725FEB] w-1/3">
      <router-link to="/"> Logo </router-link>
    </h1>
    <ul class="flex w-1/3 justify-between text-[#F4F4F4] font-bold">
      <li
        class="flex items-center h-12 px-4 hover:text-[#725FEB] hover:border-b-2 hover:border-b-[#725FEB] hover:cursor-pointer"
      >
        <router-link to="/"> Accueil </router-link>
      </li>
      <li
        class="flex items-center h-12 px-4 hover:text-[#725FEB] hover:border-b-2 hover:border-b-[#725FEB] hover:cursor-pointer"
      >
        Blog
      </li>
      <li
        class="flex items-center h-12 px-4 hover:text-[#725FEB] hover:border-b-2 hover:border-b-[#725FEB] hover:cursor-pointer"
      >
        <router-link to="/topics"> topics </router-link>
      </li>
      <li
        class="flex items-center h-12 px-4 hover:text-[#725FEB] hover:border-b-2 hover:border-b-[#725FEB] hover:cursor-pointer"
      >
        <router-link :to="'/users/' + `${userStore.user.id}`" v-if="userStore.user">
          Account
        </router-link>
        <p v-else>About</p>
      </li>
      <li
        class="flex items-center h-12 px-4 hover:text-[#725FEB] hover:border-b-2 hover:border-b-[#725FEB] hover:cursor-pointer"
        v-if="userStore.user"
      >
        <button @click="userStore.logout">Logout</button>
      </li>
    </ul>
    <div class="w-1/3 flex justify-end">
      <button
        class="w-[168px] h-[46px] bg-[#725FEB] text-[#F4F4F4] rounded-md font-bold hover:bg-[#F4F4F4] hover:text-[#161616]"
        @click.prevent="activeDialog"
        v-if="userStore.user"
      >
        Comment now !
      </button>
      <button
        class="w-[168px] h-[46px] bg-[#725FEB] text-[#F4F4F4] rounded-md font-bold hover:bg-[#F4F4F4] hover:text-[#161616]"
        v-else
      >
        <router-link to="/login">Login</router-link>
      </button>
    </div>
  </div>
</template>
<script setup>
import { RouterLink } from 'vue-router'
import { useAnimationStore } from '@/stores/Animations.js'
import { useUserStore } from '@/stores/Auth'
import { storeToRefs } from 'pinia'
const animationStore = useAnimationStore()
const { dialog } = storeToRefs(useAnimationStore())
const { activeDialog, desactiveDialog } = useAnimationStore()
const userStore = useUserStore()
const { user } = storeToRefs(useUserStore())
const { getUser } = useUserStore()

getUser()
</script>

<style scoped></style>
