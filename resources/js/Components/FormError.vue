<template>
    <div v-if="error" class="text-sm text-red-600 mt-2">{{ error }}</div>
</template>

<script setup>
defineProps({
    error: String
})
</script>
