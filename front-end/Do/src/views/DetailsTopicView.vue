<template>
  <main class="">
    <div class="pt-4 px-[130px] w-full h-[100px] bg-red-600] bg-[#1D1D1D]" id="banner">
      <Header />
    </div>

    <div class="pa-4 text-center bg-[#725FEB]">
      <v-dialog v-model="dialog" max-width="600">
        <v-card prepend-icon="mdi-account" title="Add comment" class="bg-[#725FEB] text-[#F4F4F4]">
          <v-card-text>
            <v-row dense>
              <v-col cols="12" md="4" sm="6">
                <v-text-field label="Topic title*" required></v-text-field>
              </v-col>

              <v-col cols="12" md="4" sm="6">
                <v-text-field label="Topic description"></v-text-field>
              </v-col>

              <v-col cols="12" md="4" sm="6">
                <v-text-field label="Topic url*" persistent-hint required></v-text-field>
              </v-col>

              <v-col cols="12" md="4" sm="6">
                <v-text-field label="Comment title*" required></v-text-field>
              </v-col>

              <v-col cols="12" md="4" sm="6">
                <v-text-field label="Comment content*" type="password" required></v-text-field>
              </v-col>
              <v-col cols="12" md="4" sm="6">
                <v-select
                  :items="['1', '2', '3', '4', '5']"
                  label="Note this topic*"
                  required
                ></v-select>
              </v-col>
            </v-row>

            <small class="text-caption text-medium-emphasis text-[#F4F4F4]]"
              >*indicates required field</small
            >
          </v-card-text>

          <v-divider></v-divider>

          <v-card-actions>
            <v-spacer></v-spacer>

            <v-btn text="Close" variant="plain" @click="desactiveDialog"></v-btn>

            <v-btn text="Save" variant="tonal" @click="desactiveDialog"></v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </div>

    <div
      class="px-[130px] flex w-full h-[300px] bg-[#725FEB] place-content-center place-items-center"
    >
      <div class="flex flex-col w-3/4 space-y-4">
        <div class="flex flex-col space-y-4 w-[700px]">
          <h1 class="text-[#F4F4F4] text-xl font-black">{{ topic.title }}</h1>
          <p class="text-white">
            {{ topic.description }}
          </p>
        </div>
        <div class="flex place-items-center">
          <startIcon v-if="commentStore.doublePlusOne >= 1 && commentStore.doublePlusOne <= 5" />
          <startIcon v-if="commentStore.doublePlusOne >= 2 && commentStore.doublePlusOne <= 5" />
          <startIcon v-if="commentStore.doublePlusOne >= 3 && commentStore.doublePlusOne <= 5" />
          <startIcon v-if="commentStore.doublePlusOne >= 4 && commentStore.doublePlusOne <= 5" />
          <startIcon v-if="commentStore.doublePlusOne === 5" />
        </div>
        <div class="flex space-x-6">
          <p class="text-[#F4F4F4]">
            <span>{{ numberOfComments }} </span><span> Commentaires</span>
          </p>
          <p class="text-[#F4F4F4]">
            <span class="text-md">{{ commentStore.doublePlusOne }} / 5</span>
            <span class="text-xl ml-2">étoiles</span>
          </p>
        </div>
      </div>
      <a
        :href="topic.url"
        class="w-1/4 h-[80px] flex flex-col place-content-center place-items-center border rounded-md border-[#F4F4F4] hover:bg-transparent"
      >
        <p href="#" class="text-[#F4F4F4] font-black text-lg">
          {{ topic.url.length > 25 ? topic.url.slice(0, 25) + '...' : topic.url }}
        </p>
        <p class="text-gray-400 font-medium">Visiter ce site web</p>
      </a>
    </div>
    <div class="w-full h-full bg-[#fcfbf1] px-[130px] flex space-x-12 py-[50px]">
      <div class="w-2/3 h-full flex flex-col space-y-6">
        <div
          class="bg-[#ffffff] border rounded-lg w-full h-[80px] flex place-items-center justify-between px-4"
        >
          <div class="flex space-x-5 place-items-center">
            <img src="../assets/73x73.png" alt="user icon" class="w-12 h-12" />
            <a href="#" class="text-blue-400 underline italic" @click.prevent="showFormField()"
              >Laisser un commentaire</a
            >
          </div>
          <div class="flex space-x-2 place-items-center">
            <startIconTransparent />
            <startIconTransparent />
            <startIconTransparent />
            <startIconTransparent />
            <startIconTransparent />
          </div>
        </div>
        <div class="bg-white p-6 border rounded-md" v-if="showForm">
          <form class="flex flex-col space-y-4" @submit.prevent="handleCreateComment()">
            <select
              name="comment_note"
              id="comment_note"
              class="border h-[50px] rounded-md w-1/6 text-gray-400 pl-6"
              v-model="comment_note"
            >
              <option value="">Une note</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
            </select>
            <input
              type="text"
              name="comment_title"
              id="comment_title"
              class="border h-[50px] pl-4 rounded-md"
              placeholder="Donnez un titre à votre commentaire"
              v-model="comment_title"
            />
            <textarea
              name="comment_description"
              id="comment_description"
              cols="30"
              rows="10"
              class="border h-[100px] pl-4 rounded-md"
              placeholder="Racontez-nous votre expérience plus en détail"
              v-model="comment_description"
            ></textarea>
            <button
              class="w-/3 border rounded-md hover:bg-[#F4F4F4] hover:text-[#1D1D1D] bg-[#725FEB] text-[#F4F4F4] h-[50px] font-black"
              type="submit"
            >
              Ajouter
            </button>
          </form>
        </div>
        <div class="bg-transparent w-full h-full flex flex-col space-y-4">
          <Comment v-for="item in comments" :key="item.id" :comment="item" />
        </div>
      </div>
      <div class="bg-white border rounded-lg w-1/3 h-[800px]"></div>
    </div>
  </main>
</template>

<script setup>
import Header from '../components/HeaderVue.vue'
import TopicBox from '@/components/TopicBoxVue.vue'
import Comment from '@/components/CommentBoxVue.vue'
import { useAnimationStore } from '@/stores/Animations.js'
import { useTopicStore } from '@/stores/Topics.js'
import { useCommentStore } from '@/stores/Comments.js'
import { storeToRefs } from 'pinia'
import startIcon from '../components/startIcon.vue'
import { useRoute } from 'vue-router'
import { useUserStore } from '@/stores/Auth'
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import startIconTransparent from '../components/startIconTransparent.vue'
const router = useRouter()
const route = useRoute()
const userStore = useUserStore()
const { getUser } = useUserStore()
const { topics, topic } = storeToRefs(useTopicStore())
const { comments, comment, numberOfComments, noteSum } = storeToRefs(useCommentStore())
const { dialog } = storeToRefs(useAnimationStore())
const { fetchTopics, fetchTopic, addtopic } = useTopicStore()
const { fetchComments, addComment } = useCommentStore()
const { activeDialog, desactiveDialog } = useAnimationStore()
const commentStore = useCommentStore()
const showForm = ref(false)
const comment_title = ref('')
const comment_description = ref('')
const comment_note = ref('')
const showFormField = () => {
  if (userStore.user) {
    if (showForm.value === false) {
      showForm.value = true
    } else {
      showForm.value = false
    }
  } else {
    router.push({ name: 'login' })
  }
}

const handleCreateComment = async () => {
  const newComment = await addComment({
    note: parseInt(comment_note.value),
    title: comment_title.value,
    description: comment_description.value,
    user_id: localStorage.getItem('jsskshshddyeegshs'),
    topic_id: route.params.id
  })
  newComment ? (showForm.value = false) : (showForm.value = true)
}

const submitForm = () => {
  console.log('Vous venez de soumettre un filtre !!')
}
getUser()
fetchTopic(route.params.id)
fetchComments(route.params.id)
fetchTopics()
</script>

<style scoped></style>
