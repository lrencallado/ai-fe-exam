<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import FormSection from '@/Components/FormSection.vue';
import ActionMessage from '@/Components/ActionMessage.vue';

const props = defineProps({
    user: Object,
});

const form = useForm({
    first_name: props.user.first_name,
    last_name: props.user.last_name,
    email: props.user.email,
    type: props.user.type,
    status: props.user.status,
});

const updateUser = () => {
    form.put(route('users.update', props.user.id), {
        errorBag: 'updateUser',
        preserveScroll: true,
        onSuccess: () => {

        },
        onError: () => {

        },
    });
};

</script>

<template>
    <AppLayout title="Edit User">
        <div class="py-12 px-2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 lg:flex">
                <FormSection @submitted="updateUser">
                    <template #title>
                        User Information
                    </template>

                    <template #description>
                        Update user account's information and email.
                    </template>

                    <template #form>
                        <!-- First Name -->
                        <div class="col-span-6">
                            <InputLabel for="first_name" value="First Name" />
                            <TextInput
                                id="first_name"
                                v-model="form.first_name"
                                type="text"
                                class="mt-1 block w-full"
                                autocomplete="first_name"
                            />
                            <InputError :message="form.errors.first_name" class="mt-2" />
                        </div>

                        <div class="col-span-6">
                            <InputLabel for="last_name" value="Last Name" />
                            <TextInput
                                id="last_name"
                                v-model="form.last_name"
                                type="text"
                                class="mt-1 block w-full"
                                autocomplete="last_name"
                            />
                            <InputError :message="form.errors.last_name" class="mt-2" />
                        </div>

                        <!-- Email -->
                        <div class="col-span-6">
                            <InputLabel for="email" value="Email" />
                            <TextInput
                                id="email"
                                v-model="form.email"
                                type="email"
                                class="mt-1 block w-full"
                                autocomplete="username"
                            />
                            <InputError :message="form.errors.email" class="mt-2" />
                        </div>

                        <div class="col-span-6">
                            <InputLabel for="type" value="Type" />
                            <select
                                id="type"
                                v-model="form.type"
                                class="border-gray-300 w-full mt-1 block dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                <option v-for="(type, index) in $page.props.user_types" :value="type" :selected="user.type == type">{{ type }}</option>
                            </select>
                            <InputError :message="form.errors.type" class="mt-2" />
                        </div>
                        <div class="col-span-6">
                            <InputLabel for="status" value="Status" />
                            <select
                                id="status"
                                v-model="form.status"
                                class="border-gray-300 w-full mt-1 block dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                <option :value="$page.props.status.ACTIVE" :selected="user.status == $page.props.status.ACTIVE">{{ $page.props.status.ACTIVE }}</option>
                                <option :value="$page.props.status.INACTIVE" :selected="user.status == $page.props.status.INACTIVE">{{ $page.props.status.INACTIVE }}</option>
                            </select>
                            <InputError :message="form.errors.status" class="mt-2" />
                        </div>
                    </template>

                    <template #actions>
                        <ActionMessage :on="form.recentlySuccessful" class="me-3">
                            Saved.
                        </ActionMessage>

                        <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Save
                        </PrimaryButton>
                    </template>
                </FormSection>
            </div>
        </div>
    </AppLayout>
</template>
