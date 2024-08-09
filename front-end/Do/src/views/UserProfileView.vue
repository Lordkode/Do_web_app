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
      class="px-[240px] flex justify-between w-full h-[200px] bg-[#725FEB] place-content-center place-items-center"
    >
      <div class="flex place-items-center space-x-4">
        <div
          class="w-24 h-24 bg-[#F4F4F4] flex place-content-center place-items-center rounded-full border"
        >
          <p class="text-3xl text-[#1D1D1D] font-black">R</p>
        </div>
        <p class="text-4xl font-black text-[#F4F4F4]">{{ userStore.user.fullname }}</p>
      </div>
      <div class="flex space-x-8 place-content-center place-items-center">
        <div class="flex flex-col space-y-1 place-content-center place-items-center">
          <p class="text-5xl font-black text-[#F4F4F4]">0</p>
          <p class="text-[#F4F4F4]">Topics</p>
        </div>
        <div class="flex flex-col place-content-center place-items-center space-y-1">
          <p class="text-5xl font-black text-[#F4F4F4]">
            {{ nomberOfCommentsByUser }}
          </p>
          <p class="text-[#F4F4F4]">Comments</p>
        </div>
      </div>
    </div>
    <div class="w-full h-full bg-[#fcfbf1] px-[130px] flex space-x-12 py-[50px]">
      <div class="w-2/3 h-full flex flex-col space-y-6">
        <div class="bg-white border rounded-md px-8 py-8 w-full flex flex-col space-y-8">
          <p class="font-bold text-2xl">Paramètres personnels</p>
          <form @submit.prevent="submitForm()" class="flex flex-col w-2/3 space-y-4">
            <button
              class="bg-[#1a44cb] px-4 py-3 rounded-full text-[#F4F4F4] font-bold hover:bg-[#d0def9] hover:text-[#1D1D1D]"
            >
              Télécharger une nouvelle photo de profil
            </button>
            <button class="px-8 py-3 bg-[#d0def9] rounded-full font-bold text-[#1a44cb] w-3/4">
              Supprimer ma photo de profil
            </button>
          </form>
          <form
            @submit.prevent="submitForm()"
            class="flex flex-col space-y-5 border rounded-md px-8 py-6"
          >
            <label for="email" class="flex flex-col space-y-3">
              <p>E-mail*</p>
              <input
                type="email"
                name="email"
                id="email"
                :value="userStore.user.email"
                class="border w-2/3 h-12 rounded-md px-8"
              />
            </label>
            <label for="fullname" class="flex flex-col space-y-3">
              <p>Full Name</p>
              <input
                type="text"
                name="fullname"
                id="email"
                :value="userStore.user.fullname"
                class="border w-2/3 h-12 rounded-md px-8"
              />
            </label>
            <label for="username" class="flex flex-col space-y-3">
              <p>Username</p>
              <input
                type="text"
                name="username"
                id="username"
                :value="userStore.user.username"
                class="border w-2/3 h-12 rounded-md px-8"
              />
            </label>
            <label for="birthdate" class="flex flex-col space-y-3">
              <p>BirthDate</p>
              <input
                type="date"
                name="birthdate"
                id="birthdate"
                :value="userStore.user.birthdate"
                class="border w-2/3 h-12 rounded-md px-8"
              />
            </label>
            <button
              class="px-8 py-3 bg-[#d0def9] rounded-full font-bold text-[#1a44cb] w-3/4"
              @click.prevent="passwordShow()"
            >
              Changer mon mot de passe ?
            </button>
            <div v-if="showpassword">
              <label for="password" class="flex flex-col space-y-3">
                <p>Old password</p>
                <input
                  type="password"
                  name="password"
                  id="password"
                  class="border w-2/3 h-12 rounded-md px-8"
                />
              </label>
              <label for="new_password" class="flex flex-col space-y-3">
                <p>New password</p>
                <input
                  type="password"
                  name="new_password"
                  id="new_password"
                  class="border w-2/3 h-12 rounded-md px-8"
                />
              </label>
            </div>
            <input
              type="submit"
              value="Enregistrer"
              class="bg-[#1a44cb] px-4 py-3 rounded-full text-[#F4F4F4] font-bold hover:bg-[#d0def9] hover:text-[#1D1D1D] w-[150px]"
            />
          </form>
        </div>
        <div class="bg-white w-full h-full flex flex-col space-y-4">
          <Comment v-for="item in commentsByUser" :key="item.id" :comment="item" />
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
const commentStore = useCommentStore()
const router = useRouter()
const route = useRoute()
const userStore = useUserStore()
const { getUser } = useUserStore()
const { topics, topic } = storeToRefs(useTopicStore())
const { comments, comment, commentsByUser, nomberOfCommentsByUser } = storeToRefs(useCommentStore())
const { dialog } = storeToRefs(useAnimationStore())
const { fetchTopics, fetchTopic } = useTopicStore()
const { fetchComments, fecthCommentsByUser } = useCommentStore()
const { activeDialog, desactiveDialog } = useAnimationStore()
const showpassword = ref(false)
const passwordShow = () => {
  if (showpassword.value === false) {
    showpassword.value = true
  } else {
    showpassword.value = false
  }
}

const submitForm = () => {
  console.log('Vous venez de soumettre un filtre !!')
}
console.log(commentsByUser)
getUser()
fecthCommentsByUser(route.params.id)
fetchTopics()
</script>

<style scoped></style>
