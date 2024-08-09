<template>
  <main class="h-screen w-full flex place-content-center place-items-center">
    <!-- Desktop version start -->
    <div class="background background-desktop flex items-center justify-center w-full h-full">
      <form
        class="bg-[#1D1D1D] flex flex-col p-12 border border-[#725FEB] rounded-lg items-center w-[564px] h-[460px] justify-center"
        @submit.prevent="submitForm()"
      >
        <div class="mb-6">
          <h1 class="text-4xl font-black text-[#725FEB]">
            <router-link to="/">Logo</router-link>
          </h1>
        </div>
        <div class="">
          <input
            v-model="formData.email"
            type="email"
            name="email"
            class="w-[422px] text-white h-[64px] border border-[#725FEB] rounded-lg items-center bg-transparent pl-4 mb-4"
            placeholder="Your email..."
          />
          <p v-if="userStore.errors.email" class="text-xs mb-4 text-red-500">
            {{ userStore.errors.email }}
          </p>
        </div>
        <div>
          <input
            v-model="formData.password"
            type="password"
            name="password"
            class="w-[422px] text-white h-[64px] border border-[#725FEB] rounded-lg items-center bg-transparent pl-4 mb-4"
            placeholder="Your password..."
          />
          <p v-if="userStore.errors.password" class="text-xs mb-4 text-red-500">
            {{ userStore.errors.password }}
          </p>
        </div>
        <input
          type="submit"
          value="Login"
          class="bg-white px-5 py-3 font-bold text-[#725FEB] rounded-lg w-[206px] h-[48px] hover:cursor-pointer hover:bg-[#725FEB] hover:text-white"
        />
        <p class="mt-4 text-white">
          Don't have account yet ?
          <router-link to="/register" class="cursor-pointer text-[#725FEB]">Sign Up</router-link>
        </p>
      </form>
    </div>
    <!-- Desktop version end -->

    <!-- Mobile version start -->
    <div class="background background-mobile flex items-center justify-center w-full h-full">
      <form
        class="bg-[#1D1D1D] flex flex-col p-6 mx-4 border border-[#725FEB] rounded-lg items-center w-full max-w-md h-auto justify-center"
        @submit.prevent="submitForm()"
      >
        <div class="mb-6">
          <h1 class="text-4xl font-black text-[#725FEB]">Logo</h1>
        </div>
        <div>
          <input
            v-model="formData.email"
            type="email"
            name="email"
            class="w-full text-white h-12 border border-[#725FEB] rounded-lg items-center bg-transparent pl-4 mb-4"
            placeholder="Your email..."
          />
          <p v-if="userStore.errors.email" class="text-xs mb-4 text-red-500">
            {{ userStore.errors.email }}
          </p>
        </div>
        <div>
          <input
            v-model="formData.password"
            type="password"
            name="password"
            class="w-full text-white h-12 border border-[#725FEB] rounded-lg items-center bg-transparent pl-4 mb-4"
            placeholder="Your password..."
          />
          <p v-if="userStore.errors.password" class="text-xs mb-4 text-red-500">
            {{ userStore.errors.password }}
          </p>
        </div>
        <input
          type="submit"
          value="Login"
          class="bg-white px-5 py-3 font-bold text-[#725FEB] rounded-lg w-52 h-10 text-center hover:cursor-pointer hover:bg-[#725FEB] hover:text-white"
        />
        <p class="mt-4 text-white">
          Don't have account yet ?
          <router-link to="/register" class="cursor-pointer text-[#725FEB]">Sign Up</router-link>
        </p>
      </form>
    </div>
    <!-- Mobile version end -->
  </main>
</template>

<script setup>
import { RouterLink } from 'vue-router'
import { useUserStore } from '@/stores/Auth'
import { ref } from 'vue'

const userStore = useUserStore()

const formData = ref({
  email: '',
  password: ''
})

const submitForm = async () => {
  await userStore.authentication('login', formData.value)
}
</script>

<style scoped>
.background {
  display: none;
}

.background-desktop {
  background-image: url('../assets/bg.png');
  background-repeat: no-repeat;
  background-size: cover;
  background-position: center;
}

.background-mobile {
  background-image: url('../assets/mobile.png');
  background-repeat: no-repeat;
  background-size: cover;
  background-position: center;
}

@media only screen and (min-width: 769px) {
  .background {
    display: none;
  }

  .background-desktop {
    display: flex;
  }
}

@media only screen and (max-width: 768px) {
  .background {
    display: none;
  }

  .background-mobile {
    display: flex;
  }
}
</style>
