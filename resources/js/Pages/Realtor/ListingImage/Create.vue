<template>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-16 space-y-6 lg:space-y-8">
        <Box class="shadow-xl rounded-2xl border border-neutral-200 dark:border-neutral-700">
            <template #header>
                <h3 class="text-2xl font-serif font-bold text-neutral-800 dark:text-neutral-100">Upload New Images</h3>
            </template>
            <form @submit.prevent="upload">
                <section class="flex flex-wrap items-center gap-4 my-4">
                    <input
                        class="flex-1 min-w-[200px] px-5 py-3 rounded-xl border border-neutral-300 dark:border-neutral-600 bg-neutral-50 dark:bg-neutral-700 text-neutral-800 dark:text-white cursor-pointer
                               file:mr-4 file:px-6 file:py-3 file:rounded-lg file:border-0 file:bg-accent-200 file:text-accent-800 file:font-semibold file:cursor-pointer file:transition-colors file:duration-200
                               hover:file:bg-accent-300 dark:file:bg-accent-700 dark:file:text-accent-200 dark:hover:file:bg-accent-600"
                        type="file" multiple @input="addFiles"
                    />
                    <button
                        type="submit"
                        class="action-button-outline flex-shrink-0 text-green-600 border-green-600 hover:bg-green-50 dark:text-green-400 dark:border-green-400 dark:hover:bg-neutral-700 disabled:opacity-50 disabled:cursor-not-allowed"
                        :disabled="!canUpload"
                    >
                        Upload
                    </button>
                    <button
                        type="reset"
                        class="action-button-outline flex-shrink-0 text-red-600 border-red-600 hover:bg-red-50 dark:text-red-400 dark:border-red-400 dark:hover:bg-neutral-700"
                        @click="reset"
                    >
                        Reset
                    </button>
                </section>
                <div v-if="imageErrors.length" class="input-error">
                    <div v-for="(error, index) in imageErrors" :key="index">
                        {{ error }}
                    </div>
                </div>
            </form>
        </Box>

        <Box v-if="listing.images.length" class="shadow-xl rounded-2xl border border-neutral-200 dark:border-neutral-700">
            <template #header>
                <h3 class="text-2xl font-serif font-bold text-neutral-800 dark:text-neutral-100">Current Listing Images</h3>
            </template>
            <section class="mt-6 grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6">
                <div
                    v-for="image in listing.images" :key="image.id"
                    class="flex flex-col justify-between items-center bg-neutral-100 dark:bg-neutral-700 rounded-xl p-4 shadow-md transition-all duration-300 hover:shadow-lg hover:scale-[1.01]"
                >
                    <img :src="image.src" class="rounded-lg w-full h-auto object-cover mb-4" alt="Listing Image" />
                    <Link
                        :href="route('realtor.listing.image.destroy', { listing: props.listing.id, image: image.id })"
                        method="delete"
                        as="button"
                        class="action-button-outline w-full text-red-600 border-red-600 hover:bg-red-50 dark:text-red-400 dark:border-red-400 dark:hover:bg-neutral-800"
                    >
                        Delete
                    </Link>
                </div>
            </section>
        </Box>
    </div>
</template>

<script setup>
import { computed } from 'vue'
import Box from '@/Components/UI/Box.vue'
import { Link, useForm } from '@inertiajs/vue3'
import MainLayout from "@/Layouts/MainLayout.vue"; // Ensure MainLayout is imported

const props = defineProps({ listing: Object })
const form = useForm({
    images: [],
})
const imageErrors = computed(() => Object.values(form.errors))
const canUpload = computed(() => form.images.length)
const upload = () => {
    form.post(
        route('realtor.listing.image.store', { listing: props.listing.id }),
        {
            onSuccess: () => form.reset('images'),
        },
    )
}
const addFiles = (event) => {
    for (const image of event.target.files) {
        form.images.push(image)
    }
}
const reset = () => form.reset('images')

defineOptions({ layout: MainLayout })
</script>

<style scoped>
/* Base styles for all buttons */
.action-button-filled {
    @apply flex items-center justify-center font-bold text-lg rounded-xl transition-all duration-300 transform hover:scale-105 disabled:opacity-50 disabled:transform-none;
}

.action-button-outline {
    @apply flex items-center justify-center font-semibold text-base rounded-xl transition-all duration-300 transform hover:scale-[1.02] border-2 py-3.5 px-6;
}

.action-button-text {
    @apply flex items-center justify-center font-semibold text-base rounded-xl transition-all duration-300 hover:underline py-3.5 px-6;
}

/* Specific error message styling */
.input-error {
    @apply mt-3 text-sm text-red-600 dark:text-red-400 font-medium space-y-1;
}
</style>
