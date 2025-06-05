<template>
    <div class="bg-white rounded-xl shadow-lg overflow-hidden group transition-all duration-300 hover:shadow-2xl hover:scale-[1.02] transform">
        <div class="h-64 bg-neutral-200 relative overflow-hidden">
            <img v-if="listing.images && listing.images.length" :src="listing.images[0].src"
                 class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                 alt="Property image">
            <div v-else class="h-full flex items-center justify-center text-neutral-500 bg-neutral-100 font-medium">No Image Available</div>
            <div
                class="absolute bottom-4 left-4 bg-accent-600 text-white px-3 py-1.5 rounded-full text-sm font-medium shadow-md">
                {{ listing.beds }} Beds
            </div>
            <div class="absolute top-4 right-4 bg-white text-neutral-900 p-2 rounded-full shadow-lg transition-all duration-300 group-hover:bg-accent-100 group-hover:text-accent-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                </svg>
            </div>
        </div>
        <div class="p-6">
            <h3 class="text-2xl font-serif font-bold text-neutral-900 mb-2">
                <Link :href="route('listing.show', { listing: listing.id })"
                      class="hover:text-accent-600 transition duration-150 leading-snug">
                    {{ listing.street }}, {{ listing.city }}
                </Link>
            </h3>
            <p class="text-sm text-neutral-500 mb-5">{{ listing.baths }} baths · {{ listing.area }} sqft</p>
            <div class="flex justify-between items-center mt-auto pt-4 border-t border-neutral-100">
                <p class="text-xl font-bold text-accent-600">
                    <Price :price="listing.price"/>
                </p>
                <Link :href="route('listing.show', { listing: listing.id })"
                      class="text-sm font-semibold text-neutral-800 hover:text-accent-600 transition duration-150 flex items-center group">
                    View Details
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1 transform group-hover:translate-x-1 transition-transform duration-150" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </Link>
            </div>
        </div>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import Price from '@/Components/Price.vue'

defineProps({
    listing: Object,
})
</script>
