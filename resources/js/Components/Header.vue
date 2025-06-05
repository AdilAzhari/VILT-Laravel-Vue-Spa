<template>
    <nav class="bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <div class="flex items-center">
                    <Link :href="route('dashboard')" class="flex items-center">
                        <svg class="h-8 w-8 text-gold-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span class="ml-2 text-2xl font-serif font-bold text-gray-900">LuxeHaven</span>
                    </Link>
                </div>
                <div class="flex items-center space-x-6">
                    <Link :href="route('listing.index')" class="text-gray-700 hover:text-gold-600 px-3 py-2 rounded-md text-sm font-medium transition duration-150">
                        Properties
                    </Link>
                    <Link v-if="$page.props.user" :href="route('realtor.listing.index')" class="text-gray-700 hover:text-gold-600 px-3 py-2 rounded-md text-sm font-medium transition duration-150">
                        Dashboard
                    </Link>
                    <Link v-else :href="route('login')" class="text-gray-700 hover:text-gold-600 px-3 py-2 rounded-md text-sm font-medium transition duration-150">
                        Login
                    </Link>
                    <Link v-if="!$page.props.user" :href="route('user-account.create')" class="bg-gold-600 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-gold-700 transition duration-150">
                        Register
                    </Link>
                    <Link :href="route('about')" class="text-gray-700 hover:text-gold-600 px-3 py-2 rounded-md text-sm font-medium transition duration-150">
                        About
                    </Link>
                    <Link :href="route('contact')" class="text-gray-700 hover:text-gold-600 px-3 py-2 rounded-md text-sm font-medium transition duration-150">
                        Contact
                    </Link>
                </div>
            </div>
        </div>
    </nav>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
</script>
