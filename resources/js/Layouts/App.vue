<script>
import { Link } from '@inertiajs/vue3';

export default {

    components: {
        Link
    }
}
</script>
<template>
    <div class="flex gap-4 sm:top-0 sm:left-0  p-6 text-right z-10 w-1/2 justify-content: space-between ">
        <Link href="posts"
            :class="{'font-bold text-red-500': $page.component === 'Posts/Index'}"
            class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Home</Link>
            <Link href="about"
                :class="{'font-bold text-red-500': $page.component === 'Posts/About'}"
                class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">About</Link>
            <Link href="login"
                :class="{'ont-bold text-red-500': $page.component === 'login'}"
                class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Login</Link>
            <Link
                :href="route('logout')"
                method="post"
                as="button"
                class="flex justify-center font-semibold text-sm text-gray-600 hover:text-gray-900 rounded-md"
                >
                Log Out
            </Link>
    </div>
    <div class="flex justify-center space-between ">
        Welcome: {{ $page.props.auth.user.name}}
    </div>

    <div class="overflow-hidden overflow-x-auto p-6 bg-white border-gray-200">
        <div v-if="$page.props.flash.message " class="text-white p-3  uppercase rounded-lg bg-green-300 mb-4 text  font-bold  text-lg text-center">
            {{ $page.props.flash.message }}
        </div>
    <slot/>
    </div>
</template>