<template>
    <div class="min-h-screen bg-neutral-50 dark:bg-neutral-900 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto text-center mb-16">
            <div
                class="inline-flex items-center justify-center w-14 h-14 bg-gradient-to-br from-amber-500 to-orange-600 rounded-full mb-6 shadow-lg">
                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
            </div>
            <h1 class="text-5xl font-serif font-extrabold text-neutral-900 dark:text-neutral-100 tracking-tight mb-4">
                Edit Your Listing
            </h1>
            <p class="text-neutral-600 dark:text-neutral-400 text-lg md:text-xl leading-relaxed">
                Perfect your property details to attract the right buyers and elevate your listing.
            </p>
        </div>

        <div class="max-w-4xl mx-auto">
            <form @submit.prevent="update" class="relative">
                <div
                    class="bg-white dark:bg-neutral-800 rounded-3xl shadow-2xl border border-neutral-200 dark:border-neutral-700 p-8 md:p-12">

                    <div class="mb-12">
                        <div class="flex items-center gap-4 mb-8">
                            <div
                                class="w-10 h-10 border-2 border-emerald-500 rounded-xl flex items-center justify-center text-emerald-600 dark:text-emerald-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"/>
                                </svg>
                            </div>
                            <h2 class="text-3xl font-serif font-bold text-neutral-800 dark:text-neutral-100">Property
                                Details</h2>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                            <div>
                                <label
                                    class="flex items-center gap-2 mb-3 text-sm font-semibold text-neutral-700 dark:text-neutral-300">
                                    <div class="w-4 h-4 text-rose-500 flex items-center justify-center">
                                        <svg class="w-full h-full" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                            <path fill-rule="evenodd"
                                                  d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                                  clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    Bedrooms
                                </label>
                                <div class="relative">
                                    <input
                                        v-model.number="form.beds"
                                        type="number"
                                        class="w-full px-5 py-4 text-lg font-medium rounded-xl border border-neutral-300 dark:border-neutral-600 bg-neutral-50 dark:bg-neutral-700 text-neutral-800 dark:text-white placeholder-neutral-400
                                               focus:border-rose-400 focus:ring-4 focus:ring-rose-100 dark:focus:ring-rose-900/30 transition-all duration-300"
                                        placeholder="3"
                                        min="0"
                                    />
                                    <div class="absolute inset-y-0 right-5 flex items-center text-neutral-400">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"/>
                                        </svg>
                                    </div>
                                </div>
                                <div v-if="form.errors.beds" class="mt-2 text-sm text-red-500 font-medium">
                                    {{ form.errors.beds }}
                                </div>
                            </div>

                            <div>
                                <label
                                    class="flex items-center gap-2 mb-3 text-sm font-semibold text-neutral-700 dark:text-neutral-300">
                                    <div class="w-4 h-4 text-blue-500 flex items-center justify-center">
                                        <svg class="w-full h-full" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                  d="M5 2a1 1 0 011 1v1h1a1 1 0 010 2H6v1a1 1 0 01-2 0V6H3a1 1 0 010-2h1V3a1 1 0 011-1zm0 10a1 1 0 011 1v1h1a1 1 0 110 2H6v1a1 1 0 11-2 0v-1H3a1 1 0 110-2h1v-1a1 1 0 011-1z"
                                                  clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    Bathrooms
                                </label>
                                <div class="relative">
                                    <input
                                        v-model.number="form.baths"
                                        type="number"
                                        class="w-full px-5 py-4 text-lg font-medium rounded-xl border border-neutral-300 dark:border-neutral-600 bg-neutral-50 dark:bg-neutral-700 text-neutral-800 dark:text-white placeholder-neutral-400
                                               focus:border-blue-400 focus:ring-4 focus:ring-blue-100 dark:focus:ring-blue-900/30 transition-all duration-300"
                                        placeholder="2"
                                        min="0"
                                        step="0.5"
                                    />
                                    <div class="absolute inset-y-0 right-5 flex items-center text-neutral-400">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10v11M20 10v11"/>
                                        </svg>
                                    </div>
                                </div>
                                <div v-if="form.errors.baths" class="mt-2 text-sm text-red-500 font-medium">
                                    {{ form.errors.baths }}
                                </div>
                            </div>

                            <div>
                                <label
                                    class="flex items-center gap-2 mb-3 text-sm font-semibold text-neutral-700 dark:text-neutral-300">
                                    <div class="w-4 h-4 text-amber-500 flex items-center justify-center">
                                        <svg class="w-full h-full" fill="none" stroke="currentColor"
                                             viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/>
                                        </svg>
                                    </div>
                                    Area (sq ft)
                                </label>
                                <div class="relative">
                                    <input
                                        v-model.number="form.area"
                                        type="number"
                                        class="w-full px-5 py-4 text-lg font-medium rounded-xl border border-neutral-300 dark:border-neutral-600 bg-neutral-50 dark:bg-neutral-700 text-neutral-800 dark:text-white placeholder-neutral-400
                                               focus:border-amber-400 focus:ring-4 focus:ring-amber-100 dark:focus:ring-amber-900/30 transition-all duration-300"
                                        placeholder="1200"
                                        min="0"
                                    />
                                    <div class="absolute inset-y-0 right-5 flex items-center text-neutral-400">
                                        <span class="text-sm font-medium">ft²</span>
                                    </div>
                                </div>
                                <div v-if="form.errors.area" class="mt-2 text-sm text-red-500 font-medium">
                                    {{ form.errors.area }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-12">
                        <div class="flex items-center gap-4 mb-8">
                            <div
                                class="w-10 h-10 border-2 border-violet-500 rounded-xl flex items-center justify-center text-violet-600 dark:text-violet-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <h2 class="text-3xl font-serif font-bold text-neutral-800 dark:text-neutral-100">Location
                                Details</h2>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-12 gap-8">
                            <div class="md:col-span-6">
                                <label
                                    class="flex items-center gap-2 mb-3 text-sm font-semibold text-neutral-700 dark:text-neutral-300">
                                    <div class="w-4 h-4 text-indigo-500 flex items-center justify-center">
                                        <svg class="w-full h-full" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                  d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                                  clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    City
                                </label>
                                <input
                                    v-model="form.city"
                                    type="text"
                                    class="w-full px-5 py-4 text-lg font-medium rounded-xl border border-neutral-300 dark:border-neutral-600 bg-neutral-50 dark:bg-neutral-700 text-neutral-800 dark:text-white placeholder-neutral-400
                                           focus:border-indigo-400 focus:ring-4 focus:ring-indigo-100 dark:focus:ring-indigo-900/30 transition-all duration-300"
                                    placeholder="San Francisco"
                                />
                                <div v-if="form.errors.city" class="mt-2 text-sm text-red-500 font-medium">
                                    {{ form.errors.city }}
                                </div>
                            </div>

                            <div class="md:col-span-6">
                                <label
                                    class="flex items-center gap-2 mb-3 text-sm font-semibold text-neutral-700 dark:text-neutral-300">
                                    <div class="w-4 h-4 text-teal-500 flex items-center justify-center">
                                        <svg class="w-full h-full" fill="none" stroke="currentColor"
                                             viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    Post Code
                                </label>
                                <input
                                    v-model="form.code"
                                    type="text"
                                    class="w-full px-5 py-4 text-lg font-medium rounded-xl border border-neutral-300 dark:border-neutral-600 bg-neutral-50 dark:bg-neutral-700 text-neutral-800 dark:text-white placeholder-neutral-400
                                           focus:border-teal-400 focus:ring-4 focus:ring-teal-100 dark:focus:ring-teal-900/30 transition-all duration-300"
                                    placeholder="94102"
                                />
                                <div v-if="form.errors.code" class="mt-2 text-sm text-red-500 font-medium">
                                    {{ form.errors.code }}
                                </div>
                            </div>

                            <div class="md:col-span-8">
                                <label
                                    class="flex items-center gap-2 mb-3 text-sm font-semibold text-neutral-700 dark:text-neutral-300">
                                    <div class="w-4 h-4 text-emerald-500 flex items-center justify-center">
                                        <svg class="w-full h-full" fill="none" stroke="currentColor"
                                             viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                                        </svg>
                                    </div>
                                    Street Name
                                </label>
                                <input
                                    v-model="form.street"
                                    type="text"
                                    class="w-full px-5 py-4 text-lg font-medium rounded-xl border border-neutral-300 dark:border-neutral-600 bg-neutral-50 dark:bg-neutral-700 text-neutral-800 dark:text-white placeholder-neutral-400
                                           focus:border-emerald-400 focus:ring-4 focus:ring-emerald-100 dark:focus:ring-emerald-900/30 transition-all duration-300"
                                    placeholder="Market Street"
                                />
                                <div v-if="form.errors.street" class="mt-2 text-sm text-red-500 font-medium">
                                    {{ form.errors.street }}
                                </div>
                            </div>

                            <div class="md:col-span-4">
                                <label
                                    class="flex items-center gap-2 mb-3 text-sm font-semibold text-neutral-700 dark:text-neutral-300">
                                    <div class="w-4 h-4 text-orange-500 flex items-center justify-center">
                                        <svg class="w-full h-full" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                  d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                                  clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    Street #
                                </label>
                                <input
                                    v-model.number="form.street_nr"
                                    type="text"
                                    class="w-full px-5 py-4 text-lg font-medium rounded-xl border border-neutral-300 dark:border-neutral-600 bg-neutral-50 dark:bg-neutral-700 text-neutral-800 dark:text-white placeholder-neutral-400
                                           focus:border-orange-400 focus:ring-4 focus:ring-orange-100 dark:focus:ring-orange-900/30 transition-all duration-300"
                                    placeholder="123"
                                />
                                <div v-if="form.errors.street_nr" class="mt-2 text-sm text-red-500 font-medium">
                                    {{ form.errors.street_nr }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-12">
                        <div class="flex items-center gap-4 mb-8">
                            <div
                                class="w-10 h-10 border-2 border-green-500 rounded-xl flex items-center justify-center text-green-600 dark:text-green-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                                </svg>
                            </div>
                            <h2 class="text-3xl font-serif font-bold text-neutral-800 dark:text-neutral-100">
                                Pricing</h2>
                        </div>

                        <div class="max-w-lg">
                            <label
                                class="flex items-center gap-2 mb-3 text-sm font-semibold text-neutral-700 dark:text-neutral-300">
                                <div class="w-4 h-4 text-green-500 flex items-center justify-center">
                                    <svg class="w-full h-full" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"/>
                                        <path fill-rule="evenodd"
                                              d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                Listing Price
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-5 flex items-center">
                                    <span class="text-2xl font-bold text-green-600 dark:text-green-400">$</span>
                                </div>
                                <input
                                    v-model.number="form.price"
                                    type="number"
                                    class="w-full pl-12 pr-5 py-5 text-2xl font-bold rounded-xl border border-green-300 dark:border-green-600 bg-green-50 dark:bg-green-700/50 text-neutral-800 dark:text-white placeholder-neutral-400
                                           focus:border-green-400 focus:ring-4 focus:ring-green-100 dark:focus:ring-green-900/30 transition-all duration-300"
                                    placeholder="750000"
                                    min="0"
                                />
                            </div>
                            <div v-if="form.errors.price" class="mt-2 text-sm text-red-500 font-medium">
                                {{ form.errors.price }}
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-center pt-8">
                        <button
                            type="submit"
                            :disabled="form.processing"
                            class="action-button-filled bg-accent-600 hover:bg-accent-700 text-white shadow-md hover:shadow-lg px-12 py-5"
                        >
                            <svg v-if="!form.processing" class="w-6 h-6 mr-3" fill="none" stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            <svg v-else class="w-6 h-6 animate-spin mr-3" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                        stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                      d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            {{ form.processing ? 'Updating Listing...' : 'Update Listing' }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
import {useForm} from '@inertiajs/vue3'
import MainLayout from "@/Layouts/MainLayout.vue";

const props = defineProps({
    listing: Object,
})

const form = useForm({
    beds: props.listing.beds,
    baths: props.listing.baths,
    area: props.listing.area,
    city: props.listing.city,
    street: props.listing.street,
    code: props.listing.code,
    street_nr: props.listing.street_nr,
    price: props.listing.price,
})

const update = () => form.put(
    route('realtor.listing.update', {listing: props.listing.id}),
)

defineOptions({layout: MainLayout})
</script>

<style scoped>
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
