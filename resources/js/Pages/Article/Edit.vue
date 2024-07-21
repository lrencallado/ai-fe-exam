<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Editor from '@tinymce/tinymce-vue';
import { useForm, router } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { ref } from "vue";

const props = defineProps({
    article: Object,
    tinymce_api_key: String,
    companies: Array,
    editors: Array,
});

let publishing = ref(false);

const form = useForm({
    image: props.article.image,
    title: props.article.title,
    link: props.article.link,
    content: props.article.content,
    status: props.article.status,
    company: props.article.company,
    date: props.article.date,
    editor: props.article.editor?.id,
});

const updateArticle = () => {
    form.put(route('articles.update', props.article.id), {
        errorBag: 'updateArticle',
        preserveScroll: true,
        onSuccess: () => {

        },
        onError: () => {

        },
    });
};

const publishArticle = () => {
    publishing = true;
    router.post(route('articles.publish', props.article.id), {
        onSuccess: () => {
            publishing = false;
        },
        onError: () => {
            publishing = false;
        },
    });
};

</script>

<template>
    <AppLayout title="All media">
        <div class="py-12 px-2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 lg:flex">
                <div class="mb-4 sm:pr-4">
                    <div class="mb-2">
                        <InputLabel for="title" value="Title" />
                        <TextInput
                            id="title"
                            v-model="form.title"
                            type="text"
                            class="mt-1 block w-full lg:w-60"
                        />
                        <InputError :message="form.errors.title" class="mt-2" />
                    </div>
                    <div class="mb-2">
                        <InputLabel for="link" value="Link" />
                        <TextInput
                            id="link"
                            v-model="form.link"
                            type="text"
                            class="mt-1 block w-full lg:w-60"
                        />
                        <InputError :message="form.errors.link" class="mt-2" />
                    </div>
                    <div class="mb-2">
                        <InputLabel for="company" value="Company" />
                        <select
                            id="company"
                            v-model="form.company"
                            class="border-gray-300 w-full mt-1 block dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            <option v-for="(company, index) in props.companies" :value="company.id">{{ company.name }}</option>
                        </select>
                        <InputError :message="form.errors.company" class="mt-2" />
                    </div>
                    <div class="mb-2">
                        <InputLabel for="date" value="Date" />
                        <TextInput
                            id="date"
                            v-model="form.date"
                            type="date"
                            class="mt-1 block w-full lg:w-60"
                        />
                        <InputError :message="form.errors.date" class="mt-2" />
                    </div>
                    <div class="mb-2">
                        <InputLabel for="editor" value="Editor" />
                        <select
                            id="editor"
                            v-model="form.editor"
                            class="border-gray-300 w-full mt-1 block dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            <option v-for="(editor, index) in props.editors" :value="editor.id" :selected="editor.id == form.editor">{{ editor.name }}</option>
                        </select>
                        <InputError :message="form.errors.company" class="mt-2" />
                    </div>
                    <div class="mb-2">
                        <InputLabel for="image" value="Image" />
                        <TextInput
                            id="image"
                            v-model="form.image"
                            type="text"
                            class="mt-1 block w-full lg:w-60"
                        />
                        <InputError :message="form.errors.image" class="mt-2" />
                    </div>
                    <div class="mb-2">
                        <div class="border-2 border-dashed min-h-[150px] dark:border-gray-700 h-auto w-full flex justify-center items-center px-2 py-2">
                            <div v-if="!form.image" class="text-gray-300 dark:text-gray-300">PREVIEW</div>
                            <img v-else :src="form.image" alt="" class="lg:w-[200px] w-full">
                        </div>
                    </div>
                    <div class="mb-2 flex justify-between">
                        <PrimaryButton @click="updateArticle" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Save
                        </PrimaryButton>
                        <PrimaryButton @click="publishArticle" :class="{ 'opacity-25': publishing }" :disabled="publishing || form.status == $page.props.status.PUBLISHED">
                            {{ form.status == $page.props.status.PUBLISHED ? 'Published' : 'Publish' }}
                        </PrimaryButton>
                    </div>
                </div>
                <div
                    class="dark:bg-gray-900 overflow-hidden w-full"
                >
                    <Editor
                        :api-key="props.tinymce_api_key"
                        :init="{
                            plugins: 'lists link image table code help wordcount',
                        }"
                        v-model="form.content"
                        class="h-[500px]"
                        />
                        <InputError :message="form.errors.content" class="mt-2" />
                </div>
            </div>
        </div>
    </AppLayout>
</template>
