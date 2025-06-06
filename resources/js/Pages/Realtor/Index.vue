<template>
    <h1 class="text-5xl font-serif font-extrabold text-neutral-900 dark:text-neutral-100 tracking-tight mb-12 md:mb-16">Your Curated Portfolio</h1>

    <section class="mb-12">
        <RealtorFilters :filters="filters" />
    </section>

    <section v-if="listings.data.length" class="grid grid-cols-1 xl:grid-cols-2 gap-8">
        <Box
            v-for="listing in listings.data"
            :key="listing.id"
            class="relative overflow-hidden rounded-2xl shadow-xl transition-all duration-300 transform group
             hover:-translate-y-2 hover:shadow-2xl hover:ring-2 hover:ring-accent-500 dark:hover:ring-accent-400
             border border-neutral-200 dark:border-neutral-700"
            :class="{
        'opacity-70 grayscale': listing.deleted_at,
        'border-l-8 border-accent-600 dark:border-accent-500': !listing.deleted_at && listing.sold_at === null, /* Active: Bold accent border */
        'border-l-8 border-green-600 dark:border-green-500': listing.sold_at !== null, /* Sold: Clear green border */
      }"
        >
            <div
                v-if="listing.deleted_at"
                class="absolute inset-0 bg-neutral-900 bg-opacity-80 flex items-center justify-center z-10 p-8"
            >
        <span
            class="text-white text-4xl md:text-5xl font-serif font-extrabold uppercase tracking-widest bg-red-800 dark:bg-red-600 px-8 py-4 rounded-xl shadow-2xl animate-pulse transform -rotate-3 select-none"
        >ARCHIVED</span>
            </div>
            <div
                v-if="listing.sold_at !== null && !listing.deleted_at"
                class="absolute inset-0 bg-green-900 bg-opacity-80 flex items-center justify-center z-10 p-8"
            >
        <span
            class="text-white text-4xl md:text-5xl font-serif font-extrabold uppercase tracking-widest bg-green-800 dark:bg-green-600 px-8 py-4 rounded-xl shadow-2xl transform rotate-3 select-none"
        >SOLD!</span>
            </div>

            <div class="flex flex-col md:flex-row gap-8 md:items-center justify-between p-6 md:p-8">
                <div class="flex-grow">
                    <div class="flex items-center gap-4 mb-3">
                        <div
                            v-if="listing.sold_at !== null && !listing.deleted_at"
                            class="text-sm font-bold uppercase py-1.5 px-4 bg-green-600 text-white rounded-full inline-block shadow-md tracking-wider"
                        >
                            Sold
                        </div>
                        <Price :price="listing.price" class="text-4xl font-extrabold text-accent-600 font-serif tracking-tight"/>
                    </div>

                    <ListingSpace :listing="listing" class="text-lg text-neutral-800 dark:text-neutral-200 mb-2 leading-tight font-semibold"/>
                    <ListingAddress :listing="listing" class="text-neutral-600 dark:text-neutral-400 text-base leading-snug"/>

                    <div v-if="listing.deleted_at" class="mt-4 text-red-600 dark:text-red-400 font-bold text-sm">
                        This listing is currently archived and inactive.
                    </div>
                </div>

                <section class="flex flex-col items-stretch gap-3 md:w-52 lg:w-48 xl:w-56 flex-shrink-0">
                    <a
                        :href="route('listing.show', { listing: listing.id })"
                        target="_blank"
                        class="action-button-filled bg-accent-600 hover:bg-accent-700 text-white shadow-md hover:shadow-lg"
                    >
                        <svg class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 24 24"
                             xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        View Property
                    </a>

                    <Link
                        :href="route('realtor.listing.edit', { listing: listing.id })"
                        class="action-button-outline border-neutral-400 dark:border-neutral-600 text-neutral-700 dark:text-neutral-300 hover:bg-neutral-100 dark:hover:bg-neutral-800"
                    >
                        <svg class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 24 24"
                             xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                        Edit Details
                    </Link>

                    <Link
                        v-if="!listing.deleted_at"
                        :href="route('realtor.listing.destroy', { listing: listing.id })"
                        as="button" method="delete"
                        class="action-button-outline border-red-500 text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20"
                    >
                        <svg class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 24 24"
                             xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        Archive Listing
                    </Link>

                    <Link
                        v-else
                        :href="route('realtor.listing.restore', { listing: listing.id })"
                        as="button" method="put"
                        class="action-button-outline border-green-500 text-green-600 hover:bg-green-50 dark:hover:bg-green-900/20"
                    >
                        <svg class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 24 24"
                             xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 4v5h.582m15.356 2A8.001 8.001 0 004 12c0 2.972 1.492 5.645 3.756 7.147m-.425 2.148a1 1 0 001.079.02l3.992-2.327a1 1 0 00-.07-1.725l-2.457-1.777M20 20v-5h-.582m-15.356-2A8.001 8.001 0 0120 12c0-2.972-1.492-5.645-3.756-7.147m.425-2.148a1 1 0 00-1.079-.02l-3.992 2.327a1 1 0 00.07 1.725l2.457 1.777"></path>
                        </svg>
                        Restore Listing
                    </Link>

                    <div class="w-full h-px bg-neutral-300 dark:bg-neutral-600 my-3"></div>

                    <Link
                        :href="route('realtor.listing.image.create', { listing: listing.id })"
                        class="action-button-text text-neutral-500 dark:text-neutral-400 hover:text-blue-600 dark:hover:text-blue-400"
                    >
                        <svg class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 24 24"
                             xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        Images ({{ listing.images_count }})
                    </Link>

<!--                    <Link-->
<!--                        :href="route('realtor.listing.offer.index', { listing: listing.id })"-->
<!--                        class="action-button-text text-neutral-500 dark:text-neutral-400 hover:text-blue-600 dark:hover:text-blue-400"-->
<!--                    >-->
<!--                        <svg class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 24 24"-->
<!--                             xmlns="http://www.w3.org/2000/svg">-->
<!--                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"-->
<!--                                  d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>-->
<!--                        </svg>-->
<!--                        Offers ({{ listing.offers_count }})-->
<!--                    </Link>-->
                </section>
            </div>
        </Box>
    </section>
    <EmptyState v-else class="py-20 bg-neutral-50 dark:bg-neutral-900 rounded-2xl shadow-inner">
        <p class="text-3xl font-serif text-neutral-500 dark:text-neutral-400 leading-relaxed text-center max-w-md mx-auto">
            No properties in your LuxeHaven portfolio yet. Let's add your first exquisite listing!
        </p>
    </EmptyState>

    <section v-if="listings.data.length" class="w-full flex justify-center mt-12 mb-6">
        <Pagination :links="listings.links"/>
    </section>
</template>

<script setup>
import ListingAddress from '@/Components/ListingAddress.vue'
import ListingSpace from '@/Components/ListingSpace.vue'
import Price from '@/Components/Price.vue'
import Box from '@/Components/UI/Box.vue'
import EmptyState from '@/Components/UI/EmptyState.vue'
import Pagination from '@/Components/UI/Pagination.vue'
import RealtorFilters from '@/Pages/Realtor/Index/Components/RealtorFilters.vue'
import { Link } from '@inertiajs/vue3'
import MainLayout from "@/Layouts/MainLayout.vue";

defineProps({
    listings: Object,
    filters: Object,
})

defineOptions({ layout: MainLayout })
</script>

<style scoped>
/* Base button styles */
.action-button-base {
    @apply inline-flex items-center justify-center w-full px-5 py-2.5 text-base font-semibold rounded-lg
    transition-all duration-200 transform hover:scale-[1.01] focus:outline-none focus:ring-2;
}

/* Filled Button variant (e.g., View Property) */
.action-button-filled {
    @apply action-button-base text-white shadow-md hover:shadow-lg focus:ring-accent-500 focus:ring-offset-2;
}

/* Outline Button variant (e.g., Edit, Archive, Restore) */
.action-button-outline {
    @apply action-button-base border-2 shadow-sm hover:shadow-md focus:ring-offset-2;
}
.action-button-outline.border-red-500:hover {
    @apply bg-red-50 dark:bg-red-900/20;
}
.action-button-outline.border-green-500:hover {
    @apply bg-green-50 dark:bg-green-900/20;
}

/* Text-only button variant (e.g., Images, Offers) */
.action-button-text {
    @apply inline-flex items-center justify-start w-full px-3 py-2 text-base font-medium rounded-lg
    transition-colors duration-200;
}
.action-button-text:hover {
    @apply transform scale-100; /* Prevent scaling for text links */
}
</style>
