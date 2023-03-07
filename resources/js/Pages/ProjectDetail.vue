<template>
    <Head title="Projects" />
    <FrontendLayout>
    Project Detail
    </FrontendLayout>
  </template>

  <script setup>
  import { Head } from '@inertiajs/vue3';
  import FrontendLayout from '@/Layouts/Frontend.vue';
  import Projects from '@/Components/Frontend/ProjectDetail.vue';

  defineProps({
    categories: Object,
    project: Object,
  });



  </script>
