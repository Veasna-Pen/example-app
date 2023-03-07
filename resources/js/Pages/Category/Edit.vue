<template>
    <AdminLayout title="Department">
        <!-- Breadcrumb -->
        <nav class="flex justify-end px-5 py-3 text-gray-700 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-800 dark:border-gray-700"
            aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="#"
                        class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z">
                            </path>
                        </svg>
                        Category
                    </a>
                </li>
            </ol>
        </nav>

        <div class="py-3">
            <div class="max-w-full mx-auto sm:px-6 lg:px-6">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                    <form @submit.prevent="updateCategory" class="p-4">
                        <div>
                            <InputLabel for="name" value="Name" />
                            <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" autofocus
                                autocomplete="Name" />
                            <InputError class="mt-2" :message="form.errors.name" />
                        </div>

                        <div class="mt-2">
                            <InputLabel for="image" value="Image" />
                            <TextInput id="image" type="file" class="mt-1 block w-full"
                                @input="form.image = $event.target.files[0]" />
                            <InputError class="mt-2" :message="form.errors.image" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing">
                                Save
                            </PrimaryButton>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import AdminLayout from '../../Layouts/AdminLayout.vue';
import { Head, useForm, router } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const props = defineProps({
    category: Object,
});
const form = useForm({
    name: props.category?.name,
    Image: null,
});
const updateCategory= () => {
    router.post(`/categories/${props.category.id}`, {

        _method: "put",
        name: form.name,
        image: form.image
    });
};
</script>
