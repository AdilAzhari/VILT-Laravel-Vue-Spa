<template>
    <div class="min-h-screen bg-gray-50">
      <Header/>

        <!-- Contact Hero -->
        <section class="relative bg-gray-900">
            <div class="absolute inset-0 bg-black opacity-50"></div>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-32 relative z-10 text-center">
                <h1 class="text-4xl font-serif font-extrabold text-white sm:text-5xl md:text-6xl">
                    Contact Our Luxury Specialists
                </h1>
                <p class="mt-6 text-xl text-gray-300 max-w-3xl mx-auto">
                    Our team is ready to assist you with all your luxury real estate needs. Reach out for personalized service.
                </p>
            </div>
        </section>

        <!-- Contact Form Section -->
        <section class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="lg:grid lg:grid-cols-2 lg:gap-12">
                    <!-- Contact Form -->
                    <div class="bg-gray-50 p-8 rounded-lg shadow-lg">
                        <h2 class="text-2xl font-serif font-bold text-gray-900 mb-6">Send Us a Message</h2>
                        <form @submit.prevent="submitForm" class="space-y-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                                <input type="text" id="name" v-model="form.name" required
                                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-gold-500 focus:border-gold-500">
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                                <input type="email" id="email" v-model="form.email" required
                                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-gold-500 focus:border-gold-500">
                            </div>

                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                                <input type="tel" id="phone" v-model="form.phone"
                                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-gold-500 focus:border-gold-500">
                            </div>

                            <div>
                                <label for="subject" class="block text-sm font-medium text-gray-700">Subject</label>
                                <select id="subject" v-model="form.subject"
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-gold-500 focus:border-gold-500">
                                    <option value="general">General Inquiry</option>
                                    <option value="buying">Buying a Property</option>
                                    <option value="selling">Selling a Property</option>
                                    <option value="valuation">Property Valuation</option>
                                    <option value="investment">Investment Consultation</option>
                                </select>
                            </div>

                            <div>
                                <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
                                <textarea id="message" rows="4" v-model="form.message" required
                                          class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-gold-500 focus:border-gold-500"></textarea>
                            </div>

                            <div>
                                <button type="submit"
                                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gold-600 hover:bg-gold-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gold-500 transition duration-150">
                                    Send Message
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Contact Information -->
                    <div class="mt-10 lg:mt-0">
                        <h2 class="text-2xl font-serif font-bold text-gray-900 mb-6">Our Offices</h2>

                        <div class="space-y-8">
                            <!-- Headquarters -->
                            <div class="flex items-start">
                                <div class="flex-shrink-0 h-12 w-12 rounded-full bg-gold-100 flex items-center justify-center">
                                    <svg class="h-6 w-6 text-gold-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg font-medium text-gray-900">Headquarters</h3>
                                    <p class="mt-1 text-gray-600">123 Luxury Avenue, Suite 1000</p>
                                    <p class="text-gray-600">Beverly Hills, CA 90210</p>
                                    <p class="mt-2 text-gray-600">
                                        <span class="font-medium">Phone:</span> (310) 555-1234
                                    </p>
                                    <p class="text-gray-600">
                                        <span class="font-medium">Email:</span> info@luxehaven.com
                                    </p>
                                </div>
                            </div>

                            <!-- New York Office -->
                            <div class="flex items-start">
                                <div class="flex-shrink-0 h-12 w-12 rounded-full bg-gold-100 flex items-center justify-center">
                                    <svg class="h-6 w-6 text-gold-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg font-medium text-gray-900">New York Office</h3>
                                    <p class="mt-1 text-gray-600">432 Park Avenue, Penthouse 90</p>
                                    <p class="text-gray-600">New York, NY 10022</p>
                                    <p class="mt-2 text-gray-600">
                                        <span class="font-medium">Phone:</span> (212) 555-5678
                                    </p>
                                    <p class="text-gray-600">
                                        <span class="font-medium">Email:</span> ny@luxehaven.com
                                    </p>
                                </div>
                            </div>

                            <!-- Miami Office -->
                            <div class="flex items-start">
                                <div class="flex-shrink-0 h-12 w-12 rounded-full bg-gold-100 flex items-center justify-center">
                                    <svg class="h-6 w-6 text-gold-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg font-medium text-gray-900">Miami Office</h3>
                                    <p class="mt-1 text-gray-600">1 Ocean Drive, Suite 2500</p>
                                    <p class="text-gray-600">Miami Beach, FL 33139</p>
                                    <p class="mt-2 text-gray-600">
                                        <span class="font-medium">Phone:</span> (305) 555-9012
                                    </p>
                                    <p class="text-gray-600">
                                        <span class="font-medium">Email:</span> miami@luxehaven.com
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-12">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Connect With Us</h3>
                            <div class="flex space-x-4">
                                <a href="#" class="text-gray-400 hover:text-gold-600 transition duration-150">
                                    <span class="sr-only">Facebook</span>
                                    <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd"></path>
                                    </svg>
                                </a>
                                <a href="#" class="text-gray-400 hover:text-gold-600 transition duration-150">
                                    <span class="sr-only">Instagram</span>
                                    <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd"></path>
                                    </svg>
                                </a>
                                <a href="#" class="text-gray-400 hover:text-gold-600 transition duration-150">
                                    <span class="sr-only">Twitter</span>
                                    <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"></path>
                                    </svg>
                                </a>
                                <a href="#" class="text-gray-400 hover:text-gold-600 transition duration-150">
                                    <span class="sr-only">LinkedIn</span>
                                    <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer (same as before) -->
        <Footer />
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import { ref } from 'vue'
import Header from "@/Components/Header.vue";
import Footer from "@/Components/Footer.vue";
const form = ref({
    name: '',
    email: '',
    phone: '',
    subject: 'general',
    message: ''
})

const submitForm = () => {
    // Handle form submission
    console.log('Form submitted:', form.value)
    alert('Thank you for your message. We will contact you shortly.')
    form.value = {
        name: '',
        email: '',
        phone: '',
        subject: 'general',
        message: ''
    }
}
</script>
