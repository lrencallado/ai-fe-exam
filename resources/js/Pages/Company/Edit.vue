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
    company: Object,
});


const form = useForm({
    logo: props.company.logo,
    name: props.company.name,
    status: props.company.status,
});

const updateCompany = () => {
    form.put(route('companies.update', props.company.id), {
        errorBag: 'updateCompany',
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
        },
        onError: () => {

        },
    });
};

</script>

<template>
    <AppLayout title="Edit Company">
        <div class="py-12 px-2">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 lg:flex">
                <FormSection @submitted="updateCompany">
                    <template #title>
                        Company Information
                    </template>

                    <template #description>
                        Update company's information.
                    </template>

                    <template #form>
                        <!-- First Name -->
                        <div class="col-span-6">
                            <InputLabel for="name" value="Name" />
                            <TextInput
                                id="name"
                                v-model="form.name"
                                type="text"
                                class="mt-1 block w-full"
                                autocomplete="name"
                            />
                            <InputError :message="form.errors.name" class="mt-2" />
                        </div>

                        <div class="col-span-6">
                            <InputLabel for="logo" value="Logo" />
                            <TextInput
                                id="logo"
                                v-model="form.logo"
                                type="text"
                                class="mt-1 block w-full"
                                autocomplete="last_name"
                            />
                            <InputError :message="form.errors.logo" class="mt-2" />
                        </div>

                        <div class="col-span-6">
                            <InputLabel for="status" value="Status" />
                            <select
                                id="status"
                                v-model="form.status"
                                class="border-gray-300 w-full mt-1 block dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                <option :value="$page.props.status.ACTIVE">{{ $page.props.status.ACTIVE }}</option>
                                <option :value="$page.props.status.INACTIVE">{{ $page.props.status.INACTIVE }}</option>
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
