<template>
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-12">
        <div class="mb-8 md:mb-10">
            <Filters :filters="filters" />
        </div>

        <div v-if="listings.data.length" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-6 md:gap-8">
            <Listing
                v-for="listing in listings.data"
                :key="listing.id"
                :listing="listing"
                class="transition-all duration-300 transform hover:scale-[1.02] hover:shadow-2xl hover:-translate-y-1 rounded-xl overflow-hidden"
            />
        </div>

        <div v-else class="py-16">
            <EmptyState class="text-center">
                <h2 class="text-3xl font-serif text-neutral-800 dark:text-neutral-200 mb-4">No Properties Match Your Criteria</h2>
                <p class="text-lg text-neutral-600 dark:text-neutral-400">Try adjusting your filters or exploring other areas.</p>
            </EmptyState>
        </div>

        <div v-if="listings.data.length" class="w-full flex justify-center mt-10 md:mt-12">
            <Pagination :links="listings.links" />
        </div>
    </section>
</template>

<script setup>
import Listing from '@/Pages/Listing/Index/Components/Listing.vue'
import Pagination from '@/Components/UI/Pagination.vue'
import Filters from '@/Pages/Listing/Index/Components/Filters.vue'
import EmptyState from '@/Components/UI/EmptyState.vue' // Make sure you have this component
import MainLayout from "@/Layouts/MainLayout.vue";

defineProps({
    listings: Object,
    filters: Object,
})

defineOptions({layout: MainLayout})
</script>
