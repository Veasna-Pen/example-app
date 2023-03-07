<script>
export default {
  props: {
    links: Array
  },
  computed: {
    filteredLinks() {
      if (!Array.isArray(this.links)) {
        return [];
      }
      return this.links.map(link => ({
        ...link,
        url: link.url || '' // replace null with empty string
      }));
    }
  }
}
</script>

<template>
  <div class="flex">
    <template v-for="(link, key) in filteredLinks" :key="key">
      <div v-if="link.url === ''" v-html="link.label"
        class="mb-1 mr-1 px-4 py-3 text-gray-400 text-sm leading-4 border rounded"></div>
      <Link :key="key" v-else :href="link.url" v-html="link.label"
        class="mb-1 mr-1 px-4 py-3 text-sm leading-4 border rounded focus:text-indigo-500 focus:border-indigo-500 hover:bg-white"
        :class="{ 'bg-indigo-200': link.active }" />
    </template>
  </div>
</template>
