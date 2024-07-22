<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import {router} from "@inertiajs/vue3";

defineProps({
    companies: Object,
});

const createCompany = () => {
    router.get(route('companies.create'));
}
</script>

<template>
    <AppLayout title="All media">
        <div class="py-12 px-2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-end mb-4">
                    <button
                        @click="createCompany"
                        type="button"
                        class="inline-flex items-center justify-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 active:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                        Create Company
                    </button>
                </div>
                <div
                    class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg"
                >
                    <div
                        class="relative overflow-x-auto shadow-md sm:rounded-lg"
                    >
                        <table
                            class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400"
                        >
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
                            >
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Actions
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Status
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(company, index) in companies.data" class="border-b dark:border-gray-700">
                                    <td class="px-6 py-4">
                                        <a
                                            :href="route('companies.edit', company.id)"
                                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline"
                                            >Edit</a
                                        >
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <img
                                                class="h-8 w-8 rounded-full object-cover mr-2"
                                                :src="company.logo"
                                                :alt="
                                                    company.name
                                                "
                                            />
                                            {{ company.name }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span v-if="$page.props.status.INACTIVE == company.status" class="inline-flex items-center rounded-md bg-yellow-50 px-2 py-1 text-xs font-medium text-yellow-800 ring-1 ring-inset ring-yellow-600/20 dark:bg-gray-900/20 dark:text-yellow-600 dark:ring-yellow-600">
                                            {{ company.status }}
                                        </span>
                                        <span v-if="$page.props.status.ACTIVE == company.status" class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20 dark:bg-gray-900/20 dark:text-green-600 dark:ring-green-600">
                                            {{ company.status }}
                                        </span>
                                    </td>
                                </tr>
                                <tr v-if="companies.data.length == 0">
                                    <td colspan="3" class="px-6 py-4">No data.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="flex justify-end mt-4">
                    <div class="inline-flex rounded-md shadow-sm just" role="group">
                        <a
                            :href="companies.prev_page_url"
                            :class="{
                                '!text-gray-400 cursor-not-allowed': companies.prev_page_url == null || companies.prev_page_url == ''
                            }"
                            class="cursor-pointer inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-s-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-blue-500 dark:focus:text-white">
                            <svg class="w-3 h-3 me-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path fill-rule="evenodd" d="M10.72 11.47a.75.75 0 0 0 0 1.06l7.5 7.5a.75.75 0 1 0 1.06-1.06L12.31 12l6.97-6.97a.75.75 0 0 0-1.06-1.06l-7.5 7.5Z" clip-rule="evenodd" />
                            <path fill-rule="evenodd" d="M4.72 11.47a.75.75 0 0 0 0 1.06l7.5 7.5a.75.75 0 1 0 1.06-1.06L6.31 12l6.97-6.97a.75.75 0 0 0-1.06-1.06l-7.5 7.5Z" clip-rule="evenodd" />
                            </svg>
                            Previous
                        </a>
                        <a
                            :href="companies.next_page_url"
                            :class="{
                                '!text-gray-400 cursor-not-allowed': companies.next_page_url == null || companies.next_page_url == ''
                            }"
                            class="cursor-pointer inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-e-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-blue-500 dark:focus:text-white">
                            Next
                            <svg class="w-3 h-3 ms-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path fill-rule="evenodd" d="M13.28 11.47a.75.75 0 0 1 0 1.06l-7.5 7.5a.75.75 0 0 1-1.06-1.06L11.69 12 4.72 5.03a.75.75 0 0 1 1.06-1.06l7.5 7.5Z" clip-rule="evenodd" />
                            <path fill-rule="evenodd" d="M19.28 11.47a.75.75 0 0 1 0 1.06l-7.5 7.5a.75.75 0 1 1-1.06-1.06L17.69 12l-6.97-6.97a.75.75 0 0 1 1.06-1.06l7.5 7.5Z" clip-rule="evenodd" />
                            </svg>

                        </a>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
