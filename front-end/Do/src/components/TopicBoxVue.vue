<template>
  <div class="border p-8 rounded-md mt-8 bg-white">
    <router-link :to="'/topics/' + `${topic.id}`" class="flex">
      <div>
        <h2 class="text-2xl font-black">{{ topic.title }}</h2>
        <div class="flex place-items-center mt-4 space-x-4">
          <div class="flex">
            <startIcon />
            <startIcon />
            <startIcon />
            <startIcon />
            <startIcon />
          </div>
          <p class="text-center">&#124;</p>
          <div class="flex space-x-8">
            <p>DoScore : <span> 4.5</span></p>
            <p><span>229 </span>commentaires</p>
          </div>
        </div>
        <div class="w-3/4 pt-10">
          <p class="text-lg">{{ topic.description }}</p>
        </div>
      </div>
      <div class="flex flex-col justify-between">
        <button class="bg-[#fcfbf1] border border-[#fcfbf1] italic w-48 py-2 rounded-full">
          <a :href="topic.url"> Voir la ressource </a>
        </button>
      </div>
    </router-link>
  </div>
</template>

<script setup>
import startIcon from './startIcon.vue'
import { RouterLink } from 'vue-router'

const props = defineProps(['topic'])
</script>

<style scoped></style>
