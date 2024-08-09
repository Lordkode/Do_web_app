<template>
  <main class="h-screen w-full flex place-content-center place-items-center">
    <!-- Desktop version start -->
    <div class="background background-desktop flex items-center justify-center w-full h-full">
      <form
        class="bg-[#1D1D1D] flex flex-col p-8 border border-[#725FEB] rounded-lg items-center w-[600px] h-[800px] justify-center"
        @submit.prevent="submitForm()"
      >
        <div class="mb-6">
          <h1 class="text-4xl font-black text-[#725FEB]"><router-link to="/">Logo</router-link></h1>
        </div>
        <div class="flex w-[422px] space-x-4 mb-4">
          <div class="flex justify-between gap-9">
            <div class="flex flex-col">
              <input
                v-model="formData.username"
                type="text"
                name="username"
                class="text-white w-48 h-[64px] border border-[#725FEB] rounded-lg items-center bg-transparent pl-4 mb-4"
                placeholder="Username..."
              />
              <p v-if="userStore.errors.username" class="text-xs text-red-500">
                {{ userStore.errors.username }}
              </p>
            </div>
            <div class="flex flex-col">
              <input
                v-model="formData.fullname"
                type="text"
                name="fullname"
                class="text-white w-48 h-[64px] border border-[#725FEB] rounded-lg items-center bg-transparent pl-4 mb-4"
                placeholder="Full Name..."
              />
              <p v-if="userStore.errors.fullname" class="text-xs text-red-500">
                {{ userStore.errors.fullname }}
              </p>
            </div>
          </div>
        </div>
        <div>
          <input
            v-model="formData.email"
            type="email"
            name="email"
            class="w-[422px] text-white h-[64px] border border-[#725FEB] rounded-lg items-center bg-transparent pl-4 mb-4"
            placeholder="Email..."
          />
          <p v-if="userStore.errors.email" class="text-xs mb-4 text-red-500">
            {{ userStore.errors.email }}
          </p>
        </div>
        <div class="flex flex-col">
          <input
            v-model="formData.birthdate"
            type="date"
            name="birthdate"
            class="w-[422px] h-[64px] border border-[#725FEB] rounded-lg items-center bg-transparent pl-4 mb-4 text-white"
            placeholder="Your birthday"
          />
          <p v-if="userStore.errors.birthdate" class="text-xs mb-4 text-red-500">
            {{ userStore.errors.birthdate }}
          </p>
        </div>
        <div class="flex flex-col">
          <input
            v-model="formData.password"
            type="password"
            name="password"
            class="w-[422px] text-white h-[64px] border border-[#725FEB] rounded-lg items-center bg-transparent pl-4 mb-4"
            placeholder="Password..."
          />
          <p v-if="userStore.errors.password" class="text-xs mb-4 text-red-500">
            {{ userStore.errors.password }}
          </p>
        </div>
        <div class="flex flex-col">
          <input
            v-model="formData.password_confirmation"
            type="password"
            name="password_confirmation"
            class="w-[422px] text-white h-[64px] border border-[#725FEB] rounded-lg items-center bg-transparent pl-4 mb-4"
            placeholder="Confirm Password..."
          />
          <p v-if="userStore.errors.password_confirmation" class="text-xs mb-4 text-red-500">
            {{ userStore.errors.password_confirmation }}
          </p>
        </div>
        <input
          type="submit"
          value="Register"
          class="bg-white px-5 py-3 font-bold text-[#725FEB] rounded-lg w-[206px] h-[48px] hover:cursor-pointer hover:bg-[#725FEB] hover:text-white"
        />
        <p class="mt-4 text-[#F4F4F4]">
          Already have account ?
          <router-link to="/login" class="cursor-pointer text-[#725FEB]">Sign In</router-link>
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
        <div class="w-full">
          <input
            v-model="formData.username"
            type="text"
            name="username"
            class="w-full text-[#F4F4F4] h-12 border border-[#725FEB] rounded-lg items-center bg-transparent pl-4 mb-4"
            placeholder="Username..."
          />
          <p v-if="userStore.errors.username" class="text-xs mb-4 text-red-500">
            {{ userStore.errors.username }}
          </p>
        </div>
        <div class="w-full">
          <input
            v-model="formData.email"
            type="email"
            name="email"
            class="w-full text-[#F4F4F4] h-12 border border-[#725FEB] rounded-lg items-center bg-transparent pl-4 mb-4"
            placeholder="Email..."
          />
          <p v-if="userStore.errors.email" class="text-xs mb-4 text-red-500">
            {{ userStore.errors.email }}
          </p>
        </div>
        <div class="w-full">
          <input
            v-model="formData.fullname"
            type="text"
            name="fullname"
            class="w-full text-[#F4F4F4] h-12 border border-[#725FEB] rounded-lg items-center bg-transparent pl-4 mb-4"
            placeholder="Full Name..."
          />
          <p v-if="userStore.errors.fullname" class="text-xs mb-4 text-red-500">
            {{ userStore.errors.fullname }}
          </p>
        </div>
        <div class="w-full">
          <input
            v-model="formData.password"
            type="password"
            name="password"
            class="w-full h-12 text-[#F4F4F4] border border-[#725FEB] rounded-lg items-center bg-transparent pl-4 mb-4"
            placeholder="Password..."
          />
          <p v-if="userStore.errors.password" class="text-xs text-red-500">
            {{ userStore.errors.password }}
          </p>
        </div>
        <div class="w-full">
          <input
            v-model="formData.password_confirmation"
            type="password"
            name="password_confirmation"
            class="w-full text-[#F4F4F4] h-12 border border-[#725FEB] rounded-lg items-center bg-transparent pl-4 mb-4"
            placeholder="Confirm Password..."
          />
        </div>
        <input
          type="submit"
          value="Register"
          class="bg-white px-5 py-3 font-bold text-[#725FEB] rounded-lg w-52 h-10 text-center hover:cursor-pointer hover:bg-[#725FEB] hover:text-white"
        />
        <p class="mt-4 text-[#F4F4F4]">
          Already have account ?
          <router-link to="/login" class="cursor-pointer text-[#725FEB]">Sign In</router-link>
        </p>
      </form>
    </div>
    <!-- Mobile version end -->
  </main>
</template>

<script setup>
import { useUserStore } from '@/stores/Auth'
import { ref } from 'vue'
import { RouterLink } from 'vue-router'

const userStore = useUserStore()

const formData = ref({
  username: '',
  fullname: '',
  email: '',
  birthdate: '',
  password: '',
  password_confirmation: ''
})

const submitForm = async () => {
  await userStore.authentication('register', formData.value)
  await userStore.getUser()
  console.log('Vous venez de vous enregistrer sur notre site !!')
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
