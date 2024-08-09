<script setup>
import { useUserStore } from '@/stores/Auth';
import { useKpiStore } from '@/stores/Dashboard';
import { computed, onMounted } from 'vue';
import { Bar } from 'vue-chartjs';
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js'

ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale)

const chartData = {
    labels: ['January', 'February', 'March'],
    datasets: [{ data: [40, 20, 12] }]
}
const chartOptions = {
    responsive: true
}

const userStore = useUserStore()
const kpiStore = useKpiStore()


onMounted(async () => {
    await userStore.allUsers()
    await kpiStore.user7Days()
})





const users = computed(() => {
    return userStore.users
})

</script>
<template>


    <div>

        <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-200">

            <div class="flex flex-col flex-1 overflow-hidden">
                <header class="flex items-center justify-between px-10 py-4 bg-white border-b-4 border-indigo-600">
                    <div class="text-3xl">Logo</div>

                    <div class="flex w-8 h-8">
                        <p class="text-gray-600 cursor-pointer">Dashboard</p>
                    </div>
                    <div class="flex w-8 h-8">
                        <p class="text-gray-600 cursor-pointer">Users</p>
                    </div>
                    <div class="flex w-8 h-8">
                        <p @click="userStore.logout()" class="text-gray-600 cursor-pointer">Logout</p>
                    </div>
                </header>
                <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
                    <div class="container py-8 mx-auto">
                        <h3 class="text-3xl font-medium text-gray-700">Dashboard</h3>
                        <div class="mt-4">
                            <div class="flex flex-wrap -mx-6">
                                <div class="w-full px-6 sm:w-1/2 xl:w-1/3">
                                    <div class="flex items-center px-5 py-6 bg-white rounded-md shadow-sm">
                                        <div class="p-3 bg-indigo-600 bg-opacity-75 rounded-full">
                                            <svg class="w-8 h-8 text-white" viewBox="0 0 28 30" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M18.2 9.08889C18.2 11.5373 16.3196 13.5222 14 13.5222C11.6804 13.5222 9.79999 11.5373 9.79999 9.08889C9.79999 6.64043 11.6804 4.65556 14 4.65556C16.3196 4.65556 18.2 6.64043 18.2 9.08889Z"
                                                    fill="currentColor"></path>
                                                <path
                                                    d="M25.2 12.0444C25.2 13.6768 23.9464 15 22.4 15C20.8536 15 19.6 13.6768 19.6 12.0444C19.6 10.4121 20.8536 9.08889 22.4 9.08889C23.9464 9.08889 25.2 10.4121 25.2 12.0444Z"
                                                    fill="currentColor"></path>
                                                <path
                                                    d="M19.6 22.3889C19.6 19.1243 17.0927 16.4778 14 16.4778C10.9072 16.4778 8.39999 19.1243 8.39999 22.3889V26.8222H19.6V22.3889Z"
                                                    fill="currentColor"></path>
                                                <path
                                                    d="M8.39999 12.0444C8.39999 13.6768 7.14639 15 5.59999 15C4.05359 15 2.79999 13.6768 2.79999 12.0444C2.79999 10.4121 4.05359 9.08889 5.59999 9.08889C7.14639 9.08889 8.39999 10.4121 8.39999 12.0444Z"
                                                    fill="currentColor"></path>
                                                <path
                                                    d="M22.4 26.8222V22.3889C22.4 20.8312 22.0195 19.3671 21.351 18.0949C21.6863 18.0039 22.0378 17.9556 22.4 17.9556C24.7197 17.9556 26.6 19.9404 26.6 22.3889V26.8222H22.4Z"
                                                    fill="currentColor"></path>
                                                <path
                                                    d="M6.64896 18.0949C5.98058 19.3671 5.59999 20.8312 5.59999 22.3889V26.8222H1.39999V22.3889C1.39999 19.9404 3.2804 17.9556 5.59999 17.9556C5.96219 17.9556 6.31367 18.0039 6.64896 18.0949Z"
                                                    fill="currentColor"></path>
                                            </svg>
                                        </div>

                                        <div class="mx-5">
                                            <h4 class="text-2xl font-semibold text-gray-700">{{ kpiStore.totalUsers }}
                                            </h4>
                                            <div class="text-gray-500">Total Users</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-full px-6 sm:w-1/2 xl:w-1/3">
                                    <div class="flex items-center px-5 py-6 bg-white rounded-md shadow-sm">
                                        <div class="p-3 bg-indigo-600 bg-opacity-75 rounded-full">
                                            <svg class="w-8 h-8 text-white" viewBox="0 0 28 30" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M18.2 9.08889C18.2 11.5373 16.3196 13.5222 14 13.5222C11.6804 13.5222 9.79999 11.5373 9.79999 9.08889C9.79999 6.64043 11.6804 4.65556 14 4.65556C16.3196 4.65556 18.2 6.64043 18.2 9.08889Z"
                                                    fill="currentColor"></path>
                                                <path
                                                    d="M25.2 12.0444C25.2 13.6768 23.9464 15 22.4 15C20.8536 15 19.6 13.6768 19.6 12.0444C19.6 10.4121 20.8536 9.08889 22.4 9.08889C23.9464 9.08889 25.2 10.4121 25.2 12.0444Z"
                                                    fill="currentColor"></path>
                                                <path
                                                    d="M19.6 22.3889C19.6 19.1243 17.0927 16.4778 14 16.4778C10.9072 16.4778 8.39999 19.1243 8.39999 22.3889V26.8222H19.6V22.3889Z"
                                                    fill="currentColor"></path>
                                                <path
                                                    d="M8.39999 12.0444C8.39999 13.6768 7.14639 15 5.59999 15C4.05359 15 2.79999 13.6768 2.79999 12.0444C2.79999 10.4121 4.05359 9.08889 5.59999 9.08889C7.14639 9.08889 8.39999 10.4121 8.39999 12.0444Z"
                                                    fill="currentColor"></path>
                                                <path
                                                    d="M22.4 26.8222V22.3889C22.4 20.8312 22.0195 19.3671 21.351 18.0949C21.6863 18.0039 22.0378 17.9556 22.4 17.9556C24.7197 17.9556 26.6 19.9404 26.6 22.3889V26.8222H22.4Z"
                                                    fill="currentColor"></path>
                                                <path
                                                    d="M6.64896 18.0949C5.98058 19.3671 5.59999 20.8312 5.59999 22.3889V26.8222H1.39999V22.3889C1.39999 19.9404 3.2804 17.9556 5.59999 17.9556C5.96219 17.9556 6.31367 18.0039 6.64896 18.0949Z"
                                                    fill="currentColor"></path>
                                            </svg>
                                        </div>

                                        <div class="mx-5">
                                            <h4 class="text-2xl font-semibold text-gray-700">{{ kpiStore.users7Day }}
                                            </h4>
                                            <div class="text-gray-500">Last 7 days sign up</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="w-full px-6 mt-6 sm:w-1/2 xl:w-1/3 sm:mt-0">
                                    <div class="flex items-center px-5 py-6 bg-white rounded-md shadow-sm">
                                        <div class="p-3 bg-orange-600 bg-opacity-75 rounded-full">
                                            <svg class="w-8 h-8 text-white" viewBox="0 0 28 28" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M4.19999 1.4C3.4268 1.4 2.79999 2.02681 2.79999 2.8C2.79999 3.57319 3.4268 4.2 4.19999 4.2H5.9069L6.33468 5.91114C6.33917 5.93092 6.34409 5.95055 6.34941 5.97001L8.24953 13.5705L6.99992 14.8201C5.23602 16.584 6.48528 19.6 8.97981 19.6H21C21.7731 19.6 22.4 18.9732 22.4 18.2C22.4 17.4268 21.7731 16.8 21 16.8H8.97983L10.3798 15.4H19.6C20.1303 15.4 20.615 15.1004 20.8521 14.6261L25.0521 6.22609C25.2691 5.79212 25.246 5.27673 24.991 4.86398C24.7357 4.45123 24.2852 4.2 23.8 4.2H8.79308L8.35818 2.46044C8.20238 1.83722 7.64241 1.4 6.99999 1.4H4.19999Z"
                                                    fill="currentColor"></path>
                                                <path
                                                    d="M22.4 23.1C22.4 24.2598 21.4598 25.2 20.3 25.2C19.1403 25.2 18.2 24.2598 18.2 23.1C18.2 21.9402 19.1403 21 20.3 21C21.4598 21 22.4 21.9402 22.4 23.1Z"
                                                    fill="currentColor"></path>
                                                <path
                                                    d="M9.1 25.2C10.2598 25.2 11.2 24.2598 11.2 23.1C11.2 21.9402 10.2598 21 9.1 21C7.9402 21 7 21.9402 7 23.1C7 24.2598 7.9402 25.2 9.1 25.2Z"
                                                    fill="currentColor"></path>
                                            </svg>
                                        </div>

                                        <div class="mx-5">
                                            <h4 class="text-2xl font-semibold text-gray-700">{{ kpiStore.totalTopics }}
                                            </h4>
                                            <div class="text-gray-500">Total Topics</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="w-full px-6 mt-6 sm:w-1/2 xl:w-1/3 xl:mt-0">
                                    <div class="flex items-center px-5 py-6 bg-white rounded-md shadow-sm">
                                        <div class="p-3 bg-pink-600 bg-opacity-75 rounded-full">
                                            <svg class="w-8 h-8 text-white" viewBox="0 0 28 28" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path d="M6.99998 11.2H21L22.4 23.8H5.59998L6.99998 11.2Z"
                                                    fill="currentColor" stroke="currentColor" stroke-width="2"
                                                    stroke-linejoin="round"></path>
                                                <path
                                                    d="M9.79999 8.4C9.79999 6.08041 11.6804 4.2 14 4.2C16.3196 4.2 18.2 6.08041 18.2 8.4V12.6C18.2 14.9197 16.3196 16.8 14 16.8C11.6804 16.8 9.79999 14.9197 9.79999 12.6V8.4Z"
                                                    stroke="currentColor" stroke-width="2"></path>
                                            </svg>
                                        </div>

                                        <div class="mx-5">
                                            <h4 class="text-2xl font-semibold text-gray-700">{{ kpiStore.post7Days }}
                                            </h4>
                                            <div class="text-gray-500">Last 7 days comments</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-8">

                        </div>

                        <div class="flex flex-col mt-8">
                            <div class="py-2">
                                <div
                                    class="inline-block min-w-full align-middle border-b border-gray-200 shadow sm:rounded-lg">
                                    <table class="min-w-full">
                                        <thead>
                                            <tr>
                                                <th
                                                    class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                                    Username</th>
                                                <th
                                                    class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                                    Fullname</th>
                                                <th
                                                    class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                                    Email</th>
                                                <!-- <th
                                                    class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                                    Role</th> -->
                                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50"></th>
                                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50"></th>
                                            </tr>
                                        </thead>

                                        <tbody class="bg-white">
                                            <tr v-for="user in users" :key="user.id">
                                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                                    <div class="flex items-center">
                                                        <div class="flex-shrink-0 w-10 h-10">
                                                            <svg class="w-10 h-10 rounded-full" version="1.1"
                                                                id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                                                                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
                                                                y="0px" viewBox="0 0 122.9 122.9"
                                                                style="enable-background:new 0 0 122.9 122.9"
                                                                xml:space="preserve">
                                                                <g>
                                                                    <path
                                                                        d="M61.4,0c17,0,32.3,6.9,43.4,18c11.1,11.1,18,26.5,18,43.4c0,17-6.9,32.3-18,43.4c-11.1,11.1-26.5,18-43.4,18 s-32.3-6.9-43.4-18C6.9,93.8,0,78.4,0,61.4c0-17,6.9-32.3,18-43.4C29.1,6.9,44.5,0,61.4,0L61.4,0z M41.3,54.3c-1.1,0-2,0.3-2.5,0.7 c-0.3,0.2-0.6,0.5-0.7,0.8c-0.2,0.4-0.3,0.8-0.2,1.4c0,1.5,0.8,3.5,2.4,5.8l0,0l0,0l5,8c2,3.2,4.1,6.5,6.8,8.9 c2.5,2.3,5.6,3.9,9.6,3.9c4.4,0,7.6-1.6,10.2-4.1c2.7-2.5,4.9-6,7-9.5l5.7-9.3c1.1-2.4,1.4-4,1.2-5c-0.1-0.6-0.8-0.8-1.8-0.9 c-0.2,0-0.5,0-0.7,0c-0.3,0-0.5,0-0.8,0c-0.2,0-0.3,0-0.4,0c-0.5,0-1,0-1.6-0.1l1.9-8.6c-14.4,2.3-25.2-8.4-40.4-2.1L43,54.4 C42.4,54.4,41.8,54.4,41.3,54.3L41.3,54.3L41.3,54.3L41.3,54.3z M18.8,95.7c7.1-2.5,19.6-3.8,25.4-7.7c1-1.3,2.1-2.9,3.1-4.3 c0.6-0.9,1.1-1.7,1.6-2.3c0.1-0.1,0.2-0.2,0.3-0.3c-2.4-2.5-4.4-5.5-6.3-8.5l-5-8C36,61.8,35,59.3,35,57.3c0-1,0.1-1.9,0.5-2.6 c0.4-0.8,1-1.5,1.7-2c0.4-0.2,0.8-0.5,1.2-0.6c-0.3-4.3-0.4-9.8-0.2-14.4c0.1-1.1,0.3-2.2,0.6-3.3c1.3-4.6,4.5-8.3,8.5-10.8 c1.4-0.9,2.9-1.6,4.6-2.2c2.9-1.1,1.5-5.5,4.7-5.6c7.5-0.2,19.8,6.2,24.6,11.4c2.8,3,4.6,7,4.9,12.3l-0.3,13.1l0,0 c1.4,0.4,2.3,1.3,2.7,2.7c0.4,1.6,0,3.8-1.4,6.9l0,0c0,0.1-0.1,0.1-0.1,0.2l-5.7,9.4c-2.2,3.6-4.5,7.3-7.5,10.1L73.7,82l0,0 c0.4,0.5,0.8,1.1,1.2,1.7c0.8,1.1,1.6,2.4,2.5,3.6c5.3,4.5,19.3,5.9,26.7,8.6c7.6-9.4,12.1-21.4,12.1-34.4c0-15.1-6.1-28.8-16-38.7 c-9.9-9.9-23.6-16-38.7-16s-28.8,6.1-38.7,16c-9.9,9.9-16,23.6-16,38.7C6.7,74.4,11.2,86.3,18.8,95.7L18.8,95.7z M77,90.5 c-1.4-1.6-2.8-3.7-4.1-5.5c-0.4-0.5-0.7-1.1-1.1-1.5c-2.7,2-6,3.3-10.3,3.3c-4.5,0-8-1.6-10.9-4.1c0,0,0,0.1-0.1,0.1 c-0.5,0.7-1,1.4-1.6,2.3c-1.1,1.6-2.3,3.3-3.4,4.8C45.6,100,71.1,106,77,90.5L77,90.5z" />
                                                                </g>
                                                            </svg>
                                                        </div>

                                                        <div class="ml-4">
                                                            <div class="text-sm font-medium leading-5 text-gray-900">
                                                                {{ user.username }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                                    <div class="text-sm leading-5 text-gray-900">{{ user.fullname }}
                                                    </div>
                                                </td>

                                                <td
                                                    class="px-6 py-4 whitespace-no-wrap text-xs border-b border-gray-200">
                                                    {{ user.email }}
                                                </td>

                                                <td
                                                    class="px-6 py-4 text-sm font-medium leading-5 text-right whitespace-no-wrap border-b border-gray-200">
                                                    <a href="#" @click="userStore.deleteUser(user.id)"
                                                        class="text-red-500 hover:text-red-700">Delete</a>
                                                </td>

                                                <td
                                                    class="px-6 py-4 text-sm font-medium leading-5 text-right whitespace-no-wrap border-b border-gray-200">
                                                    <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
    <div class="m-5">
        <Bar id="chart" :options="chartOptions" :data="chartData">
        </Bar>
    </div>
</template>
