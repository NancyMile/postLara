<script>
import AppLayout from '../../Layouts/App.vue'
import { Head } from '@inertiajs/vue3';

export default {
    components: {
        AppLayout,
        Head
    }
}
</script>

<template>
    <Head>
        <Title>About us </Title>
    </Head>
    <AppLayout>
        <div class="mb-4 w-1/4">
            About Us!
        </div>
    </AppLayout>
</template>