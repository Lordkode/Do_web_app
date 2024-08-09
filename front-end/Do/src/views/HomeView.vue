<script setup>
import { RouterLink } from 'vue-router'
import { useUserStore } from '@/stores/Auth'
import { useAnimationStore } from '@/stores/Animations.js'
import { useTopicStore } from '@/stores/Topics.js'
import { ref } from 'vue'
import Header from '../components/HeaderVue.vue'
import CategorieButton from '@/components/CategorieButtonVue.vue'
import TopicBox from '@/components/TopicBoxVue.vue'
import { storeToRefs } from 'pinia'
import { useCommentStore } from '@/stores/Comments.js'

const userStore = useUserStore()
const { getUser } = useUserStore()
const animationStore = useAnimationStore()
const { dialog } = storeToRefs(useAnimationStore())
const { activeDialog, desactiveDialog } = useAnimationStore()
const { comments, comment } = storeToRefs(useCommentStore())
const { fetchComments, addComment } = useCommentStore()
const { topics, topic, error, loading } = useTopicStore()
const { fetchTopics, addTopic } = useTopicStore()
const topicStore = useTopicStore()

const topic_title = ref('')
const topic_description = ref('')
const topic_url = ref('')

const comment_title = ref('')
const comment_note = ref()
const comment_description = ref('')
const topicData = {
  title: topic_title,
  description: topic_description,
  url: topic_url,
  user_id: localStorage.getItem('jsskshshddyeegshs')
}

const handleCreateComment = async (topicData) => {
  try {
    const newTopic = await addTopic({
      title: topic_title.value,
      description: topic_description.value,
      url: topic_url.value,
      user_id: localStorage.getItem('jsskshshddyeegshs')
    })
    if (newTopic) {
      await addComment({
        note: parseInt(comment_note.value),
        title: comment_title.value,
        description: comment_description.value,
        user_id: localStorage.getItem('jsskshshddyeegshs'),
        topic_id: newTopic
      })
    } else {
      console.log("Le topic n'a pas été ajouté !")
    }

    dialog.value = false
  } catch (error) {
    console.error(error)
  }
}
getUser()
</script>

<template>
  <main class="">
    <div class="pt-4 px-[130px] w-full h-[850px] bg-red-600]" id="banner">
      <Header />
      <div class="flex flex-col items-center px-24 pt-32">
        <h1 class="text-[64px] font-black text-[#F4F4F4] text-center">
          Exprimez-vous Libre Comme l'Oiseau avec YOWL
        </h1>
        <p class="text-[#F4F4F4] mt-4 px-32 text-center text-[24px]">
          Commentez sur n'importe quel contenu en ligne avec YOWL, et rejoignez notre communauté
          interactive dès maintenant!
        </p>
        <form @submit.prevent="search" class="relative">
          <input
            type="search"
            name="search"
            id="search"
            class="mt-8 w-[858px] placeholder:text-[#F4F4F4] h-[64px] border border-[#725FEB] rounded-lg items-center bg-transparent pl-4 mb-4"
            style="border-color: #725feb !important"
            placeholder="Search for blog, images, videos, ..."
          />
          <button type="submit" class="absolute right-4 bottom-9">
            <svg
              width="24"
              height="24"
              viewBox="0 0 24 24"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                d="M21 21L16.657 16.657M16.657 16.657C17.3998 15.9141 17.9891 15.0322 18.3912 14.0615C18.7932 13.0909 19.0002 12.0506 19.0002 11C19.0002 9.94939 18.7932 8.90908 18.3912 7.93845C17.9891 6.96782 17.3998 6.08588 16.657 5.34299C15.9141 4.6001 15.0321 4.01081 14.0615 3.60877C13.0909 3.20672 12.0506 2.99979 11 2.99979C9.94936 2.99979 8.90905 3.20672 7.93842 3.60877C6.96779 4.01081 6.08585 4.6001 5.34296 5.34299C3.84263 6.84332 2.99976 8.87821 2.99976 11C2.99976 13.1218 3.84263 15.1567 5.34296 16.657C6.84329 18.1573 8.87818 19.0002 11 19.0002C13.1217 19.0002 15.1566 18.1573 16.657 16.657Z"
                stroke="#F4F4F4"
                stroke-width="3"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
            </svg>
          </button>
        </form>
        <div class="flex space-x-4 mt-8">
          <categorie-button>Art et déco</categorie-button>
          <categorie-button>Art et déco</categorie-button>
          <categorie-button>Art et déco</categorie-button>
          <categorie-button>Art et déco</categorie-button>
        </div>
      </div>
    </div>

    <div class="pa-4 text-center bg-[#fcfbf1]">
      <v-dialog v-model="dialog" max-width="600">
        <v-card prepend-icon="mdi-account" title="Add comment" class="bg-[#725FEB] text-[#F4F4F4]">
          <v-card-text>
            <v-row dense>
              <v-col cols="12" md="4" sm="6">
                <v-text-field label="Topic title*" required v-model="topic_title"></v-text-field>
              </v-col>

              <v-col cols="12" md="4" sm="6">
                <v-text-field label="Topic description" v-model="topic_description"></v-text-field>
              </v-col>

              <v-col cols="12" md="4" sm="6">
                <v-text-field
                  label="Topic url*"
                  persistent-hint
                  required
                  v-model="topic_url"
                ></v-text-field>
              </v-col>

              <v-col cols="12" md="4" sm="6">
                <v-text-field
                  label="Comment title*"
                  required
                  v-model="comment_title"
                ></v-text-field>
              </v-col>

              <v-col cols="12" md="4" sm="6">
                <v-text-field
                  label="Comment content*"
                  type="text"
                  required
                  v-model="comment_description"
                ></v-text-field>
              </v-col>
              <v-col cols="12" md="4" sm="6">
                <v-select
                  :items="['1', '2', '3', '4', '5']"
                  label="Note this topic*"
                  required
                  v-model="comment_note"
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

            <v-btn text="Save" variant="tonal" @click="handleCreateComment()"></v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </div>
    <div class="px-[130px] w-full h-[490px] pt-8 flex space-x-12 bg-[#fcfbf1]">
      <div class="w-2/4 h-full flex flex-col space-y-8 place-content-center">
        <h2 class="font-black text-5xl">Être libre de s’exprimer c’est tout fun !</h2>
        <p class="text-[18px] font-medium">
          Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod
          tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam,
          quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo
          consequat.
        </p>
      </div>
      <div class="w-2/4 h-full relative overflow-hidden">
        <img src="../assets/image1.png" alt="femme joyeuse" class="absolute" />
      </div>
    </div>
    <div class="px-[130px] w-full h-[490px] pt-16 flex space-x-12">
      <div class="w-2/4 h-full relative overflow-hidden">
        <img src="../assets/image2.png" alt="femme joyeuse" class="absolute" />
      </div>
      <div class="w-2/4 h-full flex flex-col space-y-8 place-content-center">
        <h2 class="font-black text-5xl">Donnez votre avis sur des sujets !</h2>
        <p class="text-[18px] font-medium">
          Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod
          tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam,
          quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo
          consequat.
        </p>
      </div>
    </div>
  </main>
</template>
<style scoped>
#banner {
  background-image: url('../assets/bg.png');
  background-repeat: no-repeat;
  background-size: cover;
  background-position: center;
}
form input[type='search'] {
  border-color: #725feb;
  color: #f4f4f4;
  font-size: 18px;
}
</style>
