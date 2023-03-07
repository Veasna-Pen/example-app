<template>
    <section class="bg-white dark:bg-gray-900">
        <div class="max-w-screen-xl px-4 pb-8 mx-auto lg:pb-16">
            <div class="grid grid-cols-2 gap-8 text-gray-500 sm:gap-12 sm:grid-cols-3 lg:grid-cols-6 dark:text-gray-400 pt-6">
                <div v-for="category in categories.data" :key="category.id" class="flex items-center lg:justify-center">
                    <img :src="category.image" :alt="category.image" class="rounded-full lg:h-20" />
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
   defineProps({
        categories: Object,
   })
</script>

