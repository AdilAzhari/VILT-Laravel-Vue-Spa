<template>
    <Box class="shadow-lg">
        <template #header>
            <h3 class="text-xl font-serif font-bold text-neutral-800 dark:text-neutral-100">Your Offer</h3>
        </template>

        <div class="space-y-4">
            <div class="text-center">
                <p class="text-neutral-600 dark:text-neutral-300 text-sm mb-1">Offer Amount:</p>
                <Price :price="offer.amount" class="text-4xl font-extrabold text-accent-600 font-serif" />
            </div>

            <section class="mt-4 pt-4 border-t border-neutral-200 dark:border-neutral-700 flex flex-col sm:flex-row justify-between text-neutral-600 dark:text-neutral-300">
                <div class="text-sm">Offer made on:</div>
                <div class="font-medium text-neutral-800 dark:text-neutral-200 text-base">{{ formattedOfferMadeOn }}</div>
            </section>
        </div>
    </Box>
</template>

<script setup>
import { computed } from 'vue'
import Price from '@/Components/Price.vue'
import Box from '@/Components/UI/Box.vue'

const props = defineProps({
    offer: Object,
})

const formattedOfferMadeOn = computed(
    () => new Date(props.offer.created_at).toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
    }),
)
</script>
