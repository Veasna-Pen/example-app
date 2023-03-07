<template>

    <Link :href="`/projects/${project.id}`" class="group flex flex-col items-center text-center cursor-pointer">
    <div class="mb-6">
        <img class="h-56 rounded-lg" :src="project.image" :alt="project.image" />
    </div>
    <strong class="font-semibold text-gray-900 dark:text-white">
        Tags :
        <span class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">{{ project.category.name }}</span>
    </strong>

    <h3 class="group-hover:text-light-tail-500 text-2xl font-semibold capitalize mb-3">{{ project.name }}</h3>
    </Link>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import { router } from '@inertiajs/vue3'

defineProps({
    project: Object,
});


</script>




