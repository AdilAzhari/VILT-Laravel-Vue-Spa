<template>
    <div class="flex min-h-screen items-center justify-center bg-gray-100 p-6">
        <div class="w-full max-w-md rounded-lg bg-white p-8 shadow-xl">
            <h2 class="mb-6 text-center text-3xl font-extrabold text-gray-900">
                Create Your Account
            </h2>

            <form @submit.prevent="register" class="space-y-5">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Your Name</label>
                    <input
                        id="name"
                        v-model="form.name"
                        type="text"
                        autocomplete="name"
                        required
                        class="input-modern"
                        :class="{ 'input-error-border': form.errors.name }"
                        placeholder="John Doe"
                    />
                    <div v-if="form.errors.name" class="input-error-message">
                        {{ form.errors.name }}
                    </div>
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">E-mail Address</label>
                    <input
                        id="email"
                        v-model="form.email"
                        type="email"
                        autocomplete="email"
                        required
                        class="input-modern"
                        :class="{ 'input-error-border': form.errors.email }"
                        placeholder="you@example.com"
                    />
                    <div v-if="form.errors.email" class="input-error-message">
                        {{ form.errors.email }}
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input
                        id="password"
                        v-model="form.password"
                        type="password"
                        autocomplete="new-password"
                        required
                        class="input-modern"
                        :class="{ 'input-error-border': form.errors.password }"
                        placeholder="••••••••"
                    />
                    <div v-if="form.errors.password" class="input-error-message">
                        {{ form.errors.password }}
                    </div>
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm
                        Password</label>
                    <input
                        id="password_confirmation"
                        v-model="form.password_confirmation"
                        type="password"
                        autocomplete="new-password"
                        required
                        class="input-modern"
                        placeholder="••••••••"
                    />
                </div>

                <div>
                    <button
                        type="submit"
                        class="btn-gradient w-full py-2 px-4 rounded-md text-lg font-semibold transition duration-300 ease-in-out"
                        :disabled="form.processing"
                    >
                        <span v-if="form.processing">Creating Account...</span>
                        <span v-else>Create Account</span>
                    </button>
                </div>

                <div class="text-center text-sm mt-4">
                    <Link
                        :href="route('login')"
                        class="font-medium text-indigo-600 hover:text-indigo-500 hover:underline"
                    >
                        Already have an account? Log In here
                    </Link>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
import {useForm, Link} from '@inertiajs/vue3'

const form = useForm({
    name: null,
    email: null,
    password: null,
    password_confirmation: null,
})

const register = () => {
    form.post(route('user-account.store'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    })
}
</script>

<style scoped>
.input-modern {
    @apply block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm p-2;
}

.input-error-border {
    @apply border-red-500 focus:border-red-500 focus:ring-red-500;
}

.input-error-message {
    @apply mt-1 text-sm text-red-600;
}

.btn-gradient {
    @apply bg-gradient-to-r from-indigo-600 to-purple-600 text-white;
    @apply hover:from-indigo-700 hover:to-purple-700;
}

.btn-gradient[disabled] {
    @apply opacity-75 cursor-not-allowed;
}
</style>
