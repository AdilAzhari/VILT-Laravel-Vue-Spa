<template>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-16">
        <h1 class="text-4xl font-serif font-extrabold text-neutral-900 dark:text-neutral-100 mb-8 md:mb-12 text-center">
            Your Notifications
        </h1>

        <section v-if="notifications.data.length" class="space-y-4 md:space-y-6">
            <Box v-for="notification in notifications.data" :key="notification.id" class="shadow-lg rounded-xl border border-neutral-200 dark:border-neutral-700">
                <div class="flex justify-between items-center px-6 py-5">
                    <div>
                        <span v-if="notification.type === 'App\\Notifications\\OfferMade'" class="text-neutral-700 dark:text-neutral-300 text-lg md:text-xl font-medium">
                            Offer <Price :price="notification.data.amount" /> for
                            <Link
                                :href="route('realtor.listing.show', { listing: notification.data.listing_id })"
                                class="text-accent-600 dark:text-accent-400 hover:underline font-semibold"
                            >listing</Link> was made
                        </span>
                    </div>
                    <div>
                        <Link
                            v-if="!notification.read_at"
                            :href="route('notification.seen', { notification: notification.id })"
                            as="button"
                            method="put"
                            class="action-button-outline text-purple-600 border-purple-600 hover:bg-purple-50 dark:text-purple-400 dark:border-purple-400 dark:hover:bg-neutral-700"
                        >
                            Mark as read
                        </Link>
                    </div>
                </div>
            </Box>
        </section>

        <EmptyState v-else>No notifications yet!</EmptyState>

        <section
            v-if="notifications.data.length"
            class="w-full flex justify-center mt-10 md:mt-14 mb-8"
        >
            <Pagination :links="notifications.links" />
        </section>
    </div>
</template>

<script setup>
import Price from '@/Components/Price.vue'
import EmptyState from '@/Components/UI/EmptyState.vue'
import Pagination from '@/Components/UI/Pagination.vue'
import Box from '@/Components/UI/Box.vue' // Import Box component
import MainLayout from "@/Layouts/MainLayout.vue"; // Ensure MainLayout is imported
import { Link } from '@inertiajs/vue3'

defineProps({
    notifications: Object,
})

defineOptions({layout: MainLayout}) // Apply MainLayout
</script>

<style scoped>
/* Base styles for all buttons (add these if not globally available via a shared CSS file) */
.action-button-filled {
    @apply flex items-center justify-center font-bold text-lg rounded-xl transition-all duration-300 transform hover:scale-105 disabled:opacity-50 disabled:transform-none;
}

.action-button-outline {
    @apply flex items-center justify-center font-semibold text-base rounded-xl transition-all duration-300 transform hover:scale-[1.02] border-2 py-3.5 px-6;
}

.action-button-text {
    @apply flex items-center justify-center font-semibold text-base rounded-xl transition-all duration-300 hover:underline py-3.5 px-6;
}
</style>
