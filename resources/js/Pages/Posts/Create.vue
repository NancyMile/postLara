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
        <Title>Create</Title>
    </Head>
    <AppLayout>
        <div class="mb-4 w-1/4">
            New post!
        </div>
    </AppLayout>
</template>