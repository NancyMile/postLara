<script>
import AppLayout from '../../Layouts/App.vue'
import { Head, useForm, Link } from '@inertiajs/vue3';
import useCategories from '../../composables/categories'
import { onMounted } from 'vue';

export default {
    components: {
        AppLayout,
        Head,
        Link
    },
    props: {
        errors: Object
    },

    setup() {
        const form = useForm({
            title: '',
            content: '',
            category_id: '',
        });

        const { categories, getCategories } = useCategories()

        onMounted(() => {
            getCategories()
        })

        return {
            form,
            categories,
        }
    }
}
</script>

<template>
    <Head>
        <Title>Create</Title>
    </Head>
    <AppLayout>
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <form
                @submit.prevent="form.post(route('posts.store'))"
            >
                <div class="mb-4 content-center">
                    <label  class=" block font-bold aling-center text-lg" for="title">Title</label>
                    <input
                        class=" block mt-1 w-full border-none rounded-sm"
                        type="text"
                        placeholder="title"
                        id="title"
                        v-model="form.title"
                    />
                    <p v-if="errors.title" class=" text-red-500 font-bold">{{ errors.title }}</p>
                </div>
                <div class="mb-4 content-center">
                    <label  class=" block font-bold aling-center text-lg" for="title">Category</label>
                    <select
                        id="category_id"
                        v-model="form.category_id"
                        class="block mt-1 w-full"
                    >
                        <option value="" selected>-- Select --</option>
                        <option v-for="category in categories" :value="category.id">{{ category.name }}</option>
                    </select>
                    <p v-if="errors.category_id" class=" text-red-500 font-bold">{{ errors.category_id }}</p>
                </div>
                <div class="mb-4">
                    <label  class="aling-center text-lg font-bold" for="title">Content</label>
                    <textarea
                        class="block mt-1  w-full border-none rounded-sm"
                        placeholder="content"
                        id="content"
                        v-model="form.content"
                    ></textarea>
                    <p  v-if="errors.content" class=" text-red-500 font-bold">{{ errors.content }}</p>
                </div>
                <div class="w-1/2 flex gap-2">
                    <button
                        type="submit"
                        :disabled="form.processing"
                        class=" inline-block uppercase border w-full text-xs rounded-lg bg-blue-500 text-white p-4 mb-4 hover:bg-blue-800"
                    >
                        Save
                    </button>
                    <Link
                        class="block text-center uppercase border w-full text-xs rounded-lg bg-red-500 text-white p-4 mb-4 hover:bg-red-800"
                        :href="route('posts.index')"
                    >
                        Cancel
                    </Link>
                </div>
            </form>
        </div>
    </AppLayout>
</template>