<template>
    <Box class="shadow-lg">
        <template #header>
            <h3 class="text-xl font-serif font-bold text-neutral-800 dark:text-neutral-100">Make an Offer</h3>
        </template>
        <div>
            <form @submit.prevent="makeOffer" class="space-y-4">
                <div>
                    <label class="label text-neutral-700 dark:text-neutral-300 mb-1">Your Proposed Offer Amount:</label>
                    <input
                        v-model.number="form.amount"
                        type="text"
                        class="input-text"
                        placeholder="Enter your offer"
                        @focus="clearError"
                    />
                    <div v-if="form.errors.amount" class="text-red-500 text-sm mt-1">
                        {{ form.errors.amount }}
                    </div>
                </div>

                <div>
                    <input
                        v-model.number="form.amount"
                        type="range"
                        :min="min"
                        :max="max"
                        step="1000"
                        class="w-full h-2 bg-accent-100 rounded-lg appearance-none cursor-pointer thumb-accent-500 dark:bg-neutral-700"
                        aria-label="Offer Amount Slider"
                    />
                    <div class="flex justify-between text-neutral-500 dark:text-neutral-400 text-xs mt-1">
                        <span>Min: <Price :price="min" /></span>
                        <span>Max: <Price :price="max" /></span>
                    </div>
                </div>

                <button type="submit" class="btn-primary-filled w-full mt-2">
                    Place Your Offer
                </button>
            </form>
        </div>

        <div class="mt-4 pt-4 border-t border-neutral-200 dark:border-neutral-700 flex justify-between items-baseline text-neutral-600 dark:text-neutral-300">
            <div class="text-sm">Difference to listing price:</div>
            <div>
                <Price :price="difference" :class="{
          'text-green-600 dark:text-green-400': difference >= 0,
          'text-red-600 dark:text-red-400': difference < 0,
        }" class="font-medium text-lg" />
            </div>
        </div>
    </Box>
</template>

<script setup>
import Price from '@/Components/Price.vue'
import Box from '@/Components/UI/Box.vue'
import { useForm } from '@inertiajs/vue3'
import { computed, watch } from 'vue'
import { debounce } from 'lodash'

const props = defineProps({
    listingId: Number,
    price: Number,
})
const form = useForm({
    amount: props.price,
})

const makeOffer = () => form.post(
    route('listing.offer.store',
        {listing: props.listingId},
    ),
    {
        preserveScroll: true,
        preserveState: true,
    },
)

const difference = computed(() => form.amount - props.price)
const min = computed(() => Math.round(props.price * 0.5)) // Made min 50% of price
const max = computed(() => Math.round(props.price * 1.5)) // Made max 150% of price

const emit = defineEmits(['offerUpdated'])

watch(
    () => form.amount,
    debounce((value) => emit('offerUpdated', value), 200),
)

const clearError = () => {
    if (form.errors.amount) {
        form.errors.amount = null; // Clear the error message
    }
};
</script>
