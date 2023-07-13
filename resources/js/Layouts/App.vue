<script>
import { Link } from '@inertiajs/vue3';

export default {

    components: {
        Link
    }
}
</script>
<template>
    <div class="sm:flex gap-4 sm:top-0 sm:left-0  p-6 text-right z-10">
        <Link href="posts"
            :class="{'font-bold text-red-500': $page.component === 'Posts/Index'}"
            class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Home</Link>
            <Link href="about"
                :class="{'font-bold text-red-500': $page.component === 'Posts/About'}"
                class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">About</Link>
    </div>
    <div class="overflow-hidden overflow-x-auto p-6 bg-white border-gray-200">
    <slot/>
    </div>
</template>