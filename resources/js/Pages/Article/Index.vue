<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";

defineProps({
    articles: Array,
});
</script>

<template>
    <AppLayout title="All media">
        <div class="py-12 px-2">
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
                                        Actions
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Image
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Title
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Link
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Writer
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Editor
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Status
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(article, index) in articles">
                                    <td class="px-6 py-4">
                                        <a
                                            :href="route('articles.edit', article.id)"
                                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline"
                                            >Edit</a
                                        >
                                    </td>
                                    <th
                                        scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                                    >
                                        <img
                                            v-if="article.image"
                                            class="w-[2.20rem] h-[1.7rem] rounded-md object-cover"
                                            :src="article.image"
                                            :alt="article.title"
                                        />
                                        <svg v-else xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-9">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                        </svg>

                                    </th>
                                    <td class="px-6 py-4">{{ article.title }}</td>
                                    <td class="px-6 py-4">{{ article.link }}</td>
                                    <td class="px-6 py-4">{{ article.writer.name }}</td>
                                    <td class="px-6 py-4">{{ article.editor?.name }}</td>
                                    <td class="px-6 py-4">
                                        <span v-if="$page.props.status.FOR_EDIT == article.status" class="inline-flex items-center rounded-md bg-yellow-50 px-2 py-1 text-xs font-medium text-yellow-800 ring-1 ring-inset ring-yellow-600/20 dark:bg-gray-900/20 dark:text-yellow-600 dark:ring-yellow-600">
                                            {{ article.status }}
                                        </span>
                                        <span v-if="$page.props.status.PUBLISHED == article.status" class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20 dark:text-green-600 dark:ring-green-600">
                                            {{ article.status }}
                                        </span>
                                    </td>
                                </tr>
                                <tr v-if="articles.length == 0">
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
