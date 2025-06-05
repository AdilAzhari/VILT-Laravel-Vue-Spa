<template>
    <div class="min-h-screen bg-gray-50">
        <!-- Navigation -->
        <Header/>
        <!-- Hero Section -->
        <section class="relative bg-gray-900">
            <div class="absolute inset-0 bg-black opacity-50"></div>
            <div class="max-w-7xl mx-auto lg:flex lg:items-center relative z-10">
                <div class="px-4 py-24 sm:px-6 lg:px-8 lg:w-1/2">
                    <h1 class="text-4xl font-serif font-extra bold text-white sm:text-5xl md:text-6xl leading-tight">
                        <span class="block">Discover Exceptional</span>
                        <span class="block text-gold-400">Luxury Homes</span>
                    </h1>
                    <p class="mt-6 text-gray-300 text-lg sm:text-xl max-w-lg">
                        Curated selection of premium properties in the most exclusive locations.
                        Where elegance meets exceptional living.
                    </p>
                    <div class="mt-8 flex flex-wrap gap-4">
                        <Link :href="route('listing.index')"
                              class="inline-flex items-center justify-center px-6 py-3 text-base font-medium text-gray-900 bg-gold-500 rounded-md hover:bg-gold-400 transition duration-150">
                            Explore Listings
                        </Link>
                        <Link v-if="$page.props.user" :href="route('realtor.listing.create')"
                              class="inline-flex items-center justify-center px-6 py-3 text-base font-medium text-white border border-white rounded-md hover:bg-white hover:text-gray-900 transition duration-150">
                            Add Property
                        </Link>
                    </div>
                </div>
                <div class="hidden lg:block lg:w-1/2">
                    <img class="w-full h-full object-cover"
                         src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=1470&q=80"
                         alt="Luxury home">
                </div>
            </div>
        </section>

        <!-- Featured Listings -->
        <section class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-3xl font-serif font-bold text-gray-900 sm:text-4xl">Featured Properties</h2>
                    <div class="mt-4 h-1 w-20 bg-gold-500 mx-auto"></div>
                    <p class="mt-6 text-lg text-gray-600 max-w-2xl mx-auto">
                        Our handpicked selection of exceptional homes in prime locations
                    </p>
                </div>
                <ListingCard v-for="listing in featuredListings" :key="listing.id" :listing="listing"/>
                <div class="mt-14 text-center">
                    <Link :href="route('listing.index')"
                          class="inline-block px-8 py-3 border border-gold-600 text-gold-600 font-medium rounded-md hover:bg-gold-600 hover:text-white transition duration-150">
                        View All Properties
                    </Link>
                </div>
            </div>
        </section>

        <!-- Feature Highlights -->
        <section class="py-20 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-base font-semibold text-gold-600 uppercase tracking-wider">Why Choose Us</h2>
                    <h3 class="mt-2 text-3xl font-serif font-bold text-gray-900 sm:text-4xl">Exclusive Service for
                        Discerning Clients</h3>
                    <div class="mt-4 h-1 w-20 bg-gold-500 mx-auto"></div>
                    <p class="mt-6 text-lg text-gray-600 max-w-3xl mx-auto">
                        We provide unparalleled service to help you find or sell your luxury property with ease and
                        confidence.
                    </p>
                </div>
                <div class="grid gap-12 sm:grid-cols-2 lg:grid-cols-4">
                    <div v-for="feature in features" :key="feature.name" class="text-center">
                        <div
                            class="mx-auto h-16 w-16 flex items-center justify-center rounded-full bg-gold-100 text-gold-600 mb-4">
                            <component :is="feature.icon" class="h-8 w-8"/>
                        </div>
                        <h4 class="text-lg font-semibold text-gray-900">{{ feature.name }}</h4>
                        <p class="mt-2 text-gray-600">{{ feature.description }}</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimonials -->
        <section class="py-20 bg-gray-900 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-base font-semibold text-gold-400 uppercase tracking-wider">Testimonials</h2>
                    <h3 class="mt-2 text-3xl font-serif font-bold sm:text-4xl">What Our Clients Say</h3>
                    <div class="mt-4 h-1 w-20 bg-gold-500 mx-auto"></div>
                </div>
                <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                    <div class="bg-gray-800 p-8 rounded-lg">
                        <div class="flex items-center mb-4">
                            <div class="flex-shrink-0">
                                <svg class="h-8 w-8 text-gold-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                          d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z"
                                          clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-lg font-medium">Michael R.</h4>
                                <p class="text-gold-400 text-sm">Purchased a penthouse</p>
                            </div>
                        </div>
                        <p class="text-gray-300 italic">"LuxeHaven made the entire process seamless. Their attention to
                            detail and understanding of luxury properties is unmatched."</p>
                    </div>
                    <div class="bg-gray-800 p-8 rounded-lg">
                        <div class="flex items-center mb-4">
                            <div class="flex-shrink-0">
                                <svg class="h-8 w-8 text-gold-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                          d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z"
                                          clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-lg font-medium">Sarah L.</h4>
                                <p class="text-gold-400 text-sm">Sold a waterfront estate</p>
                            </div>
                        </div>
                        <p class="text-gray-300 italic">"The team at LuxeHaven secured a buyer for my property at 15%
                            above asking price. Their marketing strategy was exceptional."</p>
                    </div>
                    <div class="bg-gray-800 p-8 rounded-lg">
                        <div class="flex items-center mb-4">
                            <div class="flex-shrink-0">
                                <svg class="h-8 w-8 text-gold-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                          d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z"
                                          clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-lg font-medium">James & Elena T.</h4>
                                <p class="text-gold-400 text-sm">Purchased a country villa</p>
                            </div>
                        </div>
                        <p class="text-gray-300 italic">"We were impressed by their portfolio of exclusive properties
                            that aren't listed elsewhere. Found our dream home in 3 weeks."</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA -->
        <section class="relative bg-gray-900">
            <div class="absolute inset-0 overflow-hidden">
                <img class="w-full h-full object-cover opacity-20"
                     src="https://images.unsplash.com/photo-1513694203232-719a280e022f?auto=format&fit=crop&w=1470&q=80"
                     alt="Luxury living room">
            </div>
            <div class="relative max-w-7xl mx-auto py-24 px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-3xl font-serif font-bold text-white sm:text-4xl">
                    <span class="block">Ready to Begin Your Luxury</span>
                    <span class="block text-gold-400">Property Journey?</span>
                </h2>
                <p class="mt-6 text-xl text-gray-300 max-w-3xl mx-auto">
                    Connect with our team of luxury property specialists today.
                </p>
                <div class="mt-10 flex justify-center space-x-4">
                    <Link :href="route('listing.index')"
                          class="inline-flex items-center justify-center px-8 py-3 bg-gold-600 text-white font-medium rounded-md hover:bg-gold-500 transition duration-150">
                        Browse Properties
                    </Link>
                    <Link :href="route('contact')"
                          class="inline-flex items-center justify-center px-8 py-3 bg-transparent text-white border border-white font-medium rounded-md hover:bg-white hover:text-gray-900 transition duration-150">
                        Contact Us
                    </Link>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <Footer />
    </div>
</template>

<script setup>
import {Link} from '@inertiajs/vue3'
import Footer from '@/Components/Footer.vue'
import {
    HomeIcon,
    MapIcon,
    BriefcaseIcon,
    UserGroupIcon
} from '@heroicons/vue/outline'
import Header from "@/Components/Header.vue";
import ListingCard from "@/Components/ListingCard.vue";

const features = [
    {
        name: 'Exclusive Listings',
        description: 'Access to premium properties not available on public platforms, including off-market opportunities.',
        icon: HomeIcon,
    },
    {
        name: 'Global Network',
        description: 'Connections to luxury properties worldwide through our international partner network.',
        icon: MapIcon,
    },
    {
        name: 'Wealth Management',
        description: 'Integrated financial services including mortgage solutions and investment strategies.',
        icon: BriefcaseIcon,
    },
    {
        name: 'Discrete Service',
        description: 'Complete confidentiality for high-profile clients with our private concierge service.',
        icon: UserGroupIcon,
    },
]

defineProps({
    featuredListings: {
        type: Array,
        required: true,
        default: () => [],
    },
})
</script>

<style>
/* Custom gold color */
.bg-gold-100 {
    background-color: #faf3e0;
}

.bg-gold-400 {
    background-color: #e6b325;
}

.bg-gold-500 {
    background-color: #d4a017;
}

.bg-gold-600 {
    background-color: #b78c14;
}

.bg-gold-700 {
    background-color: #9a7612;
}

.text-gold-400 {
    color: #e6b325;
}

.text-gold-500 {
    color: #d4a017;
}

.text-gold-600 {
    color: #b78c14;
}

.border-gold-500 {
    border-color: #d4a017;
}

.border-gold-600 {
    border-color: #b78c14;
}

.hover\:bg-gold-500:hover {
    background-color: #d4a017;
}

.hover\:bg-gold-600:hover {
    background-color: #b78c14;
}

.hover\:text-gold-400:hover {
    color: #e6b325;
}

.focus\:ring-gold-500:focus {
    --tw-ring-color: #d4a017;
}
</style>
