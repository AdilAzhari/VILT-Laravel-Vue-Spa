<template>
    <div class="flex flex-col md:flex-row gap-5 md:gap-6 lg:gap-8">
        <Box v-if="listing.images.length" class="md:flex-1 md:w-2/3 lg:w-3/4 p-0 overflow-hidden shadow-lg rounded-lg">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-0.5">
                <img
                    v-for="image in listing.images"
                    :key="image.id"
                    :src="image.src"
                    class="w-full h-auto object-cover rounded-sm transform transition-transform duration-300 hover:scale-105"
                    alt="Listing Image"
                />
            </div>
        </Box>
        <EmptyState v-else class="md:flex-1 md:w-2/3 lg:w-3/4 flex items-center justify-center p-6 bg-neutral-100 dark:bg-neutral-800 rounded-lg shadow-lg">
            <p class="text-lg font-serif text-neutral-600 dark:text-neutral-400">No captivating images available yet.</p>
        </EmptyState>

        <div class="md:w-1/3 lg:w-1/4 flex flex-col gap-5 md:gap-6">
            <Box class="shadow-lg">
                <template #header>
                    <h3 class="text-xl font-serif font-bold text-neutral-800 dark:text-neutral-100">Property Overview</h3>
                </template>
                <div class="space-y-2">
                    <Price :price="listing.price" class="text-3xl font-extrabold text-accent-600 font-serif" />
                    <ListingSpace :listing="listing" class="text-base text-neutral-700 dark:text-neutral-300" />
                    <ListingAddress
                        :listing="listing"
                        class="text-neutral-500 dark:text-neutral-400 text-sm"
                    />
                </div>
            </Box>

            <Box class="shadow-lg">
                <template #header>
                    <h3 class="text-xl font-serif font-bold text-neutral-800 dark:text-neutral-100">Mortgage Calculator</h3>
                </template>
                <div class="space-y-3">
                    <div>
                        <label class="label text-neutral-700 dark:text-neutral-300">Interest rate ({{ interestRate }}%)</label>
                        <input
                            v-model.number="interestRate"
                            type="range" min="0.1" max="30" step="0.1"
                            class="w-full h-1.5 bg-accent-100 rounded-lg appearance-none cursor-pointer thumb-accent-500 dark:bg-neutral-700"
                            aria-label="Interest Rate"
                        />
                    </div>

                    <div>
                        <label class="label text-neutral-700 dark:text-neutral-300">Loan duration ({{ duration }} years)</label>
                        <input
                            v-model.number="duration"
                            type="range" min="3" max="35" step="1"
                            class="w-full h-1.5 bg-accent-100 rounded-lg appearance-none cursor-pointer thumb-accent-500 dark:bg-neutral-700"
                            aria-label="Loan Duration"
                        />
                    </div>

                    <div class="text-neutral-600 dark:text-neutral-300 mt-3 pt-3 border-t border-neutral-200 dark:border-neutral-700">
                        <p class="text-neutral-500 dark:text-neutral-400 text-xs mb-1">Your estimated monthly payment:</p>
                        <Price :price="monthlyPayment" class="text-2xl font-bold text-accent-600 font-serif" />
                    </div>

                    <div class="mt-3 text-neutral-600 dark:text-neutral-300 space-y-1.5">
                        <div class="flex justify-between">
                            <span class="text-neutral-500 dark:text-neutral-400 text-sm">Total payable:</span>
                            <Price :price="totalPaid" class="font-medium text-base text-neutral-800 dark:text-neutral-200" />
                        </div>
                        <div class="flex justify-between">
                            <span class="text-neutral-500 dark:text-neutral-400 text-sm">Loan amount:</span>
                            <Price :price="listing.price" class="font-medium text-base text-neutral-800 dark:text-neutral-200" />
                        </div>
                        <div class="flex justify-between">
                            <span class="text-neutral-500 dark:text-neutral-400 text-sm">Total interest:</span>
                            <Price :price="totalInterest" class="font-medium text-base text-neutral-800 dark:text-neutral-200" />
                        </div>
                    </div>
                </div>
            </Box>

            <MakeOffer
                v-if="user && !offerMade"
                :listing-id="listing.id"
                :price="listing.price"
                @offer-updated="offer = $event"
                class="shadow-lg"
            />
            <OfferMade v-if="user && offerMade" :offer="offerMade" class="shadow-lg" />
        </div>
    </div>
</template>

<script setup>
import ListingAddress from '@/Components/ListingAddress.vue'
import ListingSpace from '@/Components/ListingSpace.vue'
import Price from '@/Components/Price.vue'
import Box from '@/Components/UI/Box.vue'
import MakeOffer from '@/Pages/Listing/Show/Components/MakeOffer.vue'
import { ref, computed } from 'vue'
import { useMonthlyPayment } from '@/Composables/useMonthlyPayment'
import { usePage } from '@inertiajs/vue3'
import OfferMade from './Show/Components/OfferMade.vue'
import EmptyState from '@/Components/UI/EmptyState.vue'
import MainLayout from "@/Layouts/MainLayout.vue";

const interestRate = ref(2.5)
const duration = ref(25)

const props = defineProps({
    listing: Object,
    offerMade: Object,
})

const offer = ref(props.listing.price)

const { monthlyPayment, totalPaid, totalInterest } = useMonthlyPayment(
    offer, interestRate, duration,
)

const page = usePage()
const user = computed(
    () => page.props.user,
)

defineOptions({layout: MainLayout})
</script>

<style scoped>

input[type="range"]::-webkit-slider-thumb {
    -webkit-appearance: none;
    appearance: none;
    width: 14px; /* Slightly smaller size */
    height: 14px; /* Slightly smaller size */
    border-radius: 50%;
    background: theme('colors.accent.600'); /* Use accent color from config */
    cursor: grab;
    box-shadow: 0 0 0 2px rgba(theme('colors.accent.500'), 0.3); /* Subtle glow */
    transition: background .15s ease-in-out;
}

input[type="range"]::-moz-range-thumb {
    width: 14px;
    height: 14px;
    border-radius: 50%;
    background: theme('colors.accent.600');
    cursor: grab;
    box-shadow: 0 0 0 2px rgba(theme('colors.accent.500'), 0.3);
    transition: background .15s ease-in-out;
}

input[type="range"]::-webkit-slider-thumb:active {
    cursor: grabbing;
}

input[type="range"]::-moz-range-thumb:active {
    cursor: grabbing;
}

/* Track styling for range input */
input[type="range"]::-webkit-slider-runnable-track {
    width: 100%;
    height: 6px; /* Even thinner track */
    background: theme('colors.neutral.200'); /* Lighter track */
    border-radius: 3px;
}

input[type="range"]::-moz-range-track {
    width: 100%;
    height: 6px;
    background: theme('colors.neutral.200');
    border-radius: 3px;
}

/* Dark mode adjustments for range input */
.dark input[type="range"]::-webkit-slider-runnable-track {
    background: theme('colors.neutral.700');
}

.dark input[type="range"]::-moz-range-track {
    background: theme('colors.neutral.700');
}

/* Ensure the label has base styling for consistent look */
.label {
    @apply block text-sm font-medium mb-0.5; /* Reduced bottom margin */
}
</style>
