<template>
    <Topbar />
    <div class="flex h-screen bg-gray-200 font-roboto">
        <Sidebar />
        <div class="flex-1 flex flex-col overflow-hidden mt-8">
            Page Heading
            <header v-if="$slots.header" class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
                <slot />
            </main>
        </div>
    </div>
</template>

<script setup>
import Topbar from "../Components/Topbar.vue";
import Sidebar from "../Components/Sidebar.vue";

</script>
