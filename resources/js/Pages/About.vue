<template>
    <div class="min-h-screen bg-gray-50">
        <!-- Navigation (same as before) -->
       <Header/>

        <!-- About Hero -->
        <section class="relative bg-gray-900">
            <div class="absolute inset-0 bg-black opacity-50"></div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-32 relative z-10 text-center">
                <h1 class="text-4xl font-serif font-extrabold text-white sm:text-5xl md:text-6xl">
                    Our Story
                </h1>
                <p class="mt-6 text-xl text-gray-300 max-w-3xl mx-auto">
                    Redefining luxury real estate through exceptional service and unparalleled expertise.
                </p>
            </div>
        </section>

        <!-- About Content -->
        <section class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="lg:grid lg:grid-cols-2 lg:gap-12 items-center">
                    <!-- Our Story -->
                    <div class="mb-12 lg:mb-0">
                        <h2 class="text-2xl font-serif font-bold text-gray-900 mb-6">Who We Are</h2>
                        <div class="prose text-gray-600">
                            <p>
                                Founded in 2010, LuxeHaven Realty has established itself as a premier luxury real estate firm,
                                specializing in high-end residential properties across the most exclusive markets.
                            </p>
                            <p class="mt-4">
                                Our team of seasoned professionals brings decades of combined experience in luxury real estate,
                                offering clients unparalleled market knowledge, discretion, and personalized service.
                            </p>
                            <p class="mt-4">
                                We believe that buying or selling a luxury property should be an exceptional experience.
                                That's why we go beyond traditional real estate services to provide white-glove concierge
                                assistance at every step of the process.
                            </p>
                        </div>
                    </div>

                    <!-- Image -->
                    <div class="relative rounded-lg overflow-hidden shadow-xl">
                        <img class="w-full h-auto" src="https://images.unsplash.com/photo-1600880292203-757bb62b4baf?auto=format&fit=crop&w=1470&q=80" alt="LuxeHaven team">
                        <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-transparent to-transparent opacity-70"></div>
                        <div class="absolute bottom-0 left-0 p-6 text-white">
                            <p class="text-sm font-medium text-gold-400">Our Team</p>
                            <h3 class="text-xl font-serif font-bold mt-1">Dedicated to Excellence</h3>
                        </div>
                    </div>
                </div>

                <!-- Our Values -->
                <div class="mt-20">
                    <h2 class="text-2xl font-serif font-bold text-gray-900 mb-6 text-center">Our Values</h2>
                    <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-4 mt-12">
                        <div class="text-center">
                            <div class="mx-auto h-16 w-16 flex items-center justify-center rounded-full bg-gold-100 text-gold-600 mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900">Integrity</h3>
                            <p class="mt-2 text-gray-600">
                                We uphold the highest ethical standards in all our dealings.
                            </p>
                        </div>
                        <div class="text-center">
                            <div class="mx-auto h-16 w-16 flex items-center justify-center rounded-full bg-gold-100 text-gold-600 mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900">Excellence</h3>
                            <p class="mt-2 text-gray-600">
                                We strive for perfection in every detail of our service.
                            </p>
                        </div>
                        <div class="text-center">
                            <div class="mx-auto h-16 w-16 flex items-center justify-center rounded-full bg-gold-100 text-gold-600 mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900">Discretion</h3>
                            <p class="mt-2 text-gray-600">
                                Client confidentiality is our top priority.
                            </p>
                        </div>
                        <div class="text-center">
                            <div class="mx-auto h-16 w-16 flex items-center justify-center rounded-full bg-gold-100 text-gold-600 mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900">Results</h3>
                            <p class="mt-2 text-gray-600">
                                We deliver exceptional outcomes for our clients.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Team Section -->
                <div class="mt-20">
                    <h2 class="text-2xl font-serif font-bold text-gray-900 mb-6 text-center">Meet Our Leadership</h2>
                    <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3 mt-12">
                        <div class="bg-white rounded-lg shadow-md overflow-hidden">
                            <img class="w-full h-64 object-cover" src="https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&w=687&q=80" alt="Sarah Johnson">
                            <div class="p-6">
                                <h3 class="text-xl font-serif font-semibold text-gray-900">Sarah Johnson</h3>
                                <p class="text-gold-600">Founder & CEO</p>
                                <p class="mt-3 text-gray-600">
                                    With over 20 years in luxury real estate, Sarah has built LuxeHaven into an industry leader.
                                </p>
                            </div>
                        </div>
                        <div class="bg-white rounded-lg shadow-md overflow-hidden">
                            <img class="w-full h-64 object-cover" src="https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?auto=format&fit=crop&w=687&q=80" alt="Michael Chen">
                            <div class="p-6">
                                <h3 class="text-xl font-serif font-semibold text-gray-900">Michael Chen</h3>
                                <p class="text-gold-600">Managing Director</p>
                                <p class="mt-3 text-gray-600">
                                    Michael oversees our global operations and strategic partnerships.
                                </p>
                            </div>
                        </div>
                        <div class="bg-white rounded-lg shadow-md overflow-hidden">
                            <img class="w-full h-64 object-cover" src="https://images.unsplash.com/photo-1551836022-d5d88e9218df?auto=format&fit=crop&w=687&q=80" alt="Elena Rodriguez">
                            <div class="p-6">
                                <h3 class="text-xl font-serif font-semibold text-gray-900">Elena Rodriguez</h3>
                                <p class="text-gold-600">Director of Sales</p>
                                <p class="mt-3 text-gray-600">
                                    Elena leads our sales team with a focus on exceptional client experiences.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Stats Section -->
                <div class="mt-20 bg-gray-900 text-white rounded-lg p-8 sm:p-12">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                        <div>
                            <p class="text-4xl font-serif font-bold text-gold-400">12+</p>
                            <p class="mt-2 text-gray-300">Years in Business</p>
                        </div>
                        <div>
                            <p class="text-4xl font-serif font-bold text-gold-400">$4.2B</p>
                            <p class="mt-2 text-gray-300">Total Sales Volume</p>
                        </div>
                        <div>
                            <p class="text-4xl font-serif font-bold text-gold-400">250+</p>
                            <p class="mt-2 text-gray-300">Luxury Properties Sold</p>
                        </div>
                        <div>
                            <p class="text-4xl font-serif font-bold text-gold-400">98%</p>
                            <p class="mt-2 text-gray-300">Client Satisfaction</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="bg-gray-50 py-20">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-3xl font-serif font-bold text-gray-900 sm:text-4xl">
                    Ready to Experience the LuxeHaven Difference?
                </h2>
                <p class="mt-4 text-lg text-gray-600 max-w-3xl mx-auto">
                    Whether you're buying, selling, or investing in luxury real estate, our team is here to provide unparalleled service.
                </p>
                <div class="mt-8">
                    <Link :href="route('contact')" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-gold-600 hover:bg-gold-700 transition duration-150">
                        Contact Our Team
                    </Link>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <Footer/>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import Header from "@/Components/Header.vue";
import Footer from "@/Components/Footer.vue";
</script>
