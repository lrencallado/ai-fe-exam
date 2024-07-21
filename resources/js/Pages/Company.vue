<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";

defineProps({
    companies: Array,
});
</script>

<template>
    <AppLayout title="Companies">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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
                                        Action
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Logo
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
                                <tr v-if="companies">
                                    <td class="px-6 py-4">
                                        <a
                                            href="#"
                                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline"
                                            >Edit</a
                                        >
                                    </td>
                                    <th
                                        scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                                    >
                                        Apple Watch 5
                                    </th>
                                    <td class="px-6 py-4">Red</td>
                                    <td class="px-6 py-4">Wearables</td>
                                </tr>
                                <tr v-else>
                                    <td colspan="3" class="px-6 py-4">No data.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
