<template>
    <Head title="Welcome" />
    <FrontendLayout>
    <!---Hero Section-->
    <HeroSection/>

    <!--Category Section-->
    <Category :categories="categories"/>

    <!---Project Section-->
    <AllPoject :categories="categories" :projects="projects" />

    </FrontendLayout>
</template>

<script setup>
    import { Head, Link } from '@inertiajs/vue3';
    import FrontendLayout from '@/Layouts/Frontend.vue';
    import HeroSection from '@/Components/Frontend/Hero.vue';
    import Category from '@/Components/Frontend/Category.vue';
    import AllPoject from '@/Components/Frontend/AllProject.vue';

    defineProps({
    categories: Object,
    projects: Object,
  });
</script>

