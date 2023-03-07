<template>
    <div v-if="project">
      <div class="mb-6">
        <img class="h-56 rounded-lg" :src="project.image" :alt="project.name" />
      </div>
      <strong class="font-semibold text-gray-900 dark:text-white">
        Tags :
        <span class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">{{ project.category.name }}</span>
      </strong>
      <h3 class="group-hover:text-light-tail-500 text-2xl font-semibold capitalize mb-3">{{ project.name }}</h3>
    </div>
    <div v-else>
      Project not found.
    </div>
  </template>

  <script setup>
  import { defineProps } from 'vue'

  defineProps({
    project: {
      type: Object,
      default: null,
    },
  })
  </script>
