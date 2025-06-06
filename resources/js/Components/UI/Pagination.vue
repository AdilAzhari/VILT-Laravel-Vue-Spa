<template>

    <div class="flex gap-2">
        <template v-for="(link, index) in links" :key="index">
            <Link
                v-if="link.url"
                :href="link.url"
                class="py-2 px-4 rounded-lg text-sm font-medium transition-colors duration-200"
                :class="{
          'bg-accent-600 text-white shadow-md hover:bg-accent-700': link.active, /* Active link styling */
          'bg-neutral-100 text-neutral-700 hover:bg-neutral-200 dark:bg-neutral-800 dark:text-neutral-300 dark:hover:bg-neutral-700': !link.active, /* Inactive link styling */
        }"
                v-html="link.label"
            />
            <span
                v-else
                class="py-2 px-4 rounded-lg text-sm font-medium text-neutral-400 cursor-not-allowed bg-neutral-50 dark:bg-neutral-900 dark:text-neutral-600"
                v-html="link.label"
            />
        </template>
    </div>
</template>

<script setup>
import {Link} from '@inertiajs/vue3'

defineProps({
    links: Array, // links array from Inertia pagination
})
</script>
