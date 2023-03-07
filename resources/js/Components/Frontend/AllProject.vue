<template>
    <section id="project" class="bg-white dark:bg-gray-900">
        <div class="max-w-screen-xl px-4 py-8 mx-auto lg:py-24 lg:px-6">
            <div class="max-w-screen-md mx-auto mb-8 text-center lg:mb-12">
                <h2 class="mb-2 text-3xl font-bold text-gray-900 dark:text-white">My Latest Project</h2>
                <!-- <p class="mb-5 font-light text-gray-500 sm:text-xl dark:text-gray-400">We focus on markets where technology,
                    innovation, and capital can unlock long-term value and drive economic growth.</p> -->
            </div>
            <Projects :categories="categories" :projects="projects" />
        </div>
    </section>
</template>

<script setup>
import Projects from "./Projects.vue";
defineProps({
    categories: Object,
    projects: Object,
})
</script>
