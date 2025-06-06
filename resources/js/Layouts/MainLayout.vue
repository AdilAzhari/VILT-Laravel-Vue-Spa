<template>
    <header class="border-b border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-900 w-full shadow-sm">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="py-4 flex items-center justify-between flex-wrap">
                <div class="flex items-center space-x-6">
                    <div class="text-xl font-medium text-neutral-800 dark:text-neutral-200 hover:text-accent-600 dark:hover:text-accent-400 transition-colors duration-200">
                        <Link :href="route('listing.index')">Explore Listings</Link>
                    </div>
                </div>

                <div class="flex-grow text-center">
                    <Link :href="route('listing.index')" class="text-4xl sm:text-5xl font-serif font-extrabold text-accent-600 dark:text-accent-400 leading-none">
                        LuxeHaven
                    </Link>
                </div>

                <div v-if="user" class="flex items-center gap-6 md:gap-8 ml-auto">
                    <Link
                        class="relative text-neutral-500 dark:text-neutral-300 hover:text-accent-600 dark:hover:text-accent-400 transition-colors duration-200"
                        :href="route('notification.index')"
                        aria-label="Notifications"
                    >
                        <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.002 2.002 0 0118 14.59V10a6 6 0 00-12 0v4.59c0 .538-.214 1.055-.595 1.405L4 17h5m6 0a3 3 0 11-6 0m6 0H9"></path></svg>
                        <div
                            v-if="notificationCount"
                            class="absolute -top-1 -right-1 w-5 h-5 bg-red-600 text-white font-bold border-2 border-white dark:border-neutral-900 rounded-full text-xs flex items-center justify-center animate-pulse"
                        >
                            {{ notificationCount }}
                        </div>
                    </Link>

                    <Link :href="route('realtor.listing.index')" class="text-md font-medium text-neutral-700 dark:text-neutral-300 hover:text-accent-600 dark:hover:text-accent-400 transition-colors duration-200 hidden sm:block">
                        Welcome, {{ user.name }}
                    </Link>

                    <Link :href="route('realtor.listing.create')" class="btn-primary-filled">
                        + New Listing
                    </Link>

                    <div>
                        <Link :href="route('logout')" method="delete" as="button" class="btn-secondary-outline">
                            Logout
                        </Link>
                    </div>
                </div>

                <div v-else class="flex items-center gap-4 ml-auto">
                    <Link :href="route('login')" class="btn-secondary-outline">Sign In</Link>
                    <Link :href="route('user-account.create')" class="btn-primary-filled">Register</Link>
                </div>
            </nav>
        </div>
    </header>

    <main class="container mx-auto px-4 sm:px-6 lg:px-8 py-6 md:py-8 w-full">
        <div
            v-if="flashSuccess"
            class="mb-6 rounded-lg p-4 bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 border border-green-200 dark:border-green-700 shadow-md transition-all duration-300"
            role="alert"
        >
            <div class="flex items-center">
                <svg class="h-6 w-6 mr-3 text-green-500 dark:text-green-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                <p class="font-semibold">{{ flashSuccess }}</p>
            </div>
        </div>
        <slot></slot>
    </main>
</template>

<script setup>
import {computed} from 'vue'
import {Link, usePage} from '@inertiajs/vue3'

const page = usePage()
const flashSuccess = computed(
    () => page.props.flash.success,
)
const user = computed(
    () => page.props.user,
)
const notificationCount = computed(
    () => Math.min(page.props.user?.notificationCount || 0, 9), // Added nullish coalescing for safety
)
</script>
