<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { router } from '@inertiajs/vue3'

const props = defineProps({
    articles: Object,
});

const createArticle = () => {
    router.post(route('articles.store'));
}
</script>

<template>
    <AppLayout title="Dashboard">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg"
                >
                    <div>
                        <div
                            v-if="$page.props.auth.user.type == $page.props.user_types.WRITER"
                            class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700"
                        >
                            <h1
                                class="mt-2 text-2xl font-medium text-gray-900 dark:text-white"
                            >
                                Welcome to your Dashboard!
                            </h1>

                            <button
                                @click="createArticle"
                                type="button"
                                class="inline-flex items-center justify-center mt-4 px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 active:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                Create Article
                            </button>

                            <p
                                class="mt-6 text-gray-500 dark:text-gray-400 leading-relaxed"
                            >

                            </p>
                        </div>
                        <div class="bg-indigo-500 dark:bg-indigo-800 p-2 text-center text-white font-bold text-lg">
                            Article List Preview
                        </div>
                        <div
                        v-for="(article, index) in props.articles"
                            class="bg-gray-200 dark:bg-gray-800 bg-opacity-25 grid grid-cols-1 md:grid-cols-4 gap-y-4 md:gap-6 lg:gap-8 p-6 lg:p-8 border-b border-gray-200 dark:border-gray-700"
                        >
                            <div class="flex justify-center">
                                <img
                                    class="h-full w-[200px] rounded-md object-cover"
                                    :src="article.image"
                                    :alt="article.title"
                                />
                            </div>
                            <div class="col-span-3">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke-width="1.5"
                                            class="w-6 h-6 stroke-gray-400"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"
                                            />
                                        </svg>
                                        <h2
                                            class="ms-3 text-xl font-semibold text-gray-900 dark:text-white"
                                        >
                                            <a href="#"
                                                >{{ article.title }}</a
                                            >
                                        </h2>
                                    </div>
                                    <span v-if="$page.props.status.FOR_EDIT == article.status" class="inline-flex items-center rounded-md bg-yellow-50 px-2 py-1 text-xs font-medium text-yellow-800 ring-1 ring-inset ring-yellow-600/20 dark:bg-gray-900/20 dark:text-yellow-600 dark:ring-yellow-600">
                                        {{ article.status }}
                                    </span>
                                    <span v-if="$page.props.status.PUBLISHED == article.status" class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20 dark:bg-gray-900/20 dark:ring-green-600">
                                        {{ article.status }}
                                    </span>
                                </div>
                                <div class="text-xs text-gray-900 dark:text-white flex items-center">
                                    Writer:
                                    <span class="text-gray-600 dark:text-white ml-2">{{ article.writer.name }}</span>
                                </div>
                                <div v-if="article.editor" class="text-xs text-gray-900 dark:text-white flex items-center mt-1">
                                    Editor:
                                    <span class="text-gray-600 dark:text-white ml-2">{{ article.editor.name }}</span>
                                </div>
                                <div class="text-xs text-gray-900 dark:text-white flex items-center mt-1">
                                    Date:
                                    <span class="text-gray-600 dark:text-white ml-2">{{ article.date }}</span>
                                </div>
                                <div class="text-xs text-gray-900 dark:text-white flex items-center mt-1">
                                    Link:
                                    <span class="text-gray-600 dark:text-white ml-2">{{ article.link }}</span>
                                </div>

                                <div
                                    v-html="article.content ?? 'No Data.' "
                                    class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed truncate"
                                >

                                </div>

                                <p class="mt-4 text-sm">
                                    <a
                                        :href="article.link"
                                        class="inline-flex items-center font-semibold text-indigo-700 dark:text-indigo-300"
                                    >
                                        View Details

                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20"
                                            class="ms-1 w-5 h-5 fill-indigo-500 dark:fill-indigo-200"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M5 10a.75.75 0 01.75-.75h6.638L10.23 7.29a.75.75 0 111.04-1.08l3.5 3.25a.75.75 0 010 1.08l-3.5 3.25a.75.75 0 11-1.04-1.08l2.158-1.96H5.75A.75.75 0 015 10z"
                                                clip-rule="evenodd"
                                            />
                                        </svg>
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
