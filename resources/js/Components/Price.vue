<template>
    <span class="price-display" :class="componentClasses">
        {{ formattedPrice }}
    </span>
</template>

<script setup>
import {computed} from 'vue'

const props = defineProps({
    /**
     * The raw price value. Can be a number or a string.
     * @type {number | string}
     * @required
     */
    price: {
        type: [Number, String],
        required: true,
    },
    /**
     * The currency code (e.g., 'USD', 'EUR', 'MYR').
     * Defaults to 'MYR' based on your location.
     * @type {string}
     */
    currency: {
        type: String,
        default: 'MYR', // Default to Malaysian Ringgit
    },
    /**
     * The locale for formatting (e.g., 'en-US', 'ms-MY').
     * Defaults to 'ms-MY' for Malaysian locale.
     * @type {string}
     */
    locale: {
        type: String,
        default: 'en-MY',
    },
    /**
     * Minimum number of fraction digits.
     * @type {number}
     */
    minimumFractionDigits: {
        type: Number,
        default: 0,
    },
    /**
     * Maximum number of fraction digits.
     * @type {number}
     */
    maximumFractionDigits: {
        type: Number,
        default: 2, // Allow up to 2 decimal places by default
    },
    /**
     * Optional classes to apply to the root span element.
     * @type {string | Array<string> | Object}
     */
    componentClasses: {
        type: [String, Array, Object],
        default: '',
    }
})

/**
 * Computes the formatted price using the Internationalization API.
 * @returns {string} The formatted price string.
 */
const formattedPrice = computed(() => {
    // Ensure the price is a number, handling potential string inputs
    const numericPrice = parseFloat(props.price)

    // Check for invalid price inputs
    if (isNaN(numericPrice)) {
        console.warn(`Price component received invalid price value: ${props.price}. Displaying N/A.`)
        return 'N/A' // Or throw an error, depending on desired robustness
    }

    try {
        return new Intl.NumberFormat(props.locale, {
            style: 'currency',
            currency: props.currency,
            minimumFractionDigits: props.minimumFractionDigits,
            maximumFractionDigits: props.maximumFractionDigits,
        }).format(numericPrice)
    } catch (error) {
        console.error(`Error formatting price: ${error.message} with price: ${props.price}, currency: ${props.currency}, locale: ${props.locale}`)
        return numericPrice.toFixed(props.maximumFractionDigits) // Fallback to a simple fixed decimal
    }
})
</script>

<style scoped>
.price-display {
    font-weight: 600;
    color: inherit;
}
</style>
