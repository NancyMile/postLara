<script>
import AppLayout from '../../Layouts/App.vue';
import { Head, Link } from '@inertiajs/vue3';
import usePosts from '../../composables/posts'
import useCategories from '../../composables/categories'
import { ref, onMounted, watch } from 'vue';
import { Inertia } from '@inertiajs/inertia'

export default {
    components: {
        AppLayout,
        Head,
        Link
    },
    props: {
        posts: Object,
        permissions: Object,
    },

    setup() {
        const selectedCategory = ref('')
        const orderColumn = ref('created_at')
        const orderDirection = ref('desc')
        const { posts, getPosts } = usePosts()
        const { categories, getCategories } = useCategories()


        onMounted(() => {
            getPosts()
            getCategories()
        })


        watch(selectedCategory, (current, previous) => {
            getPosts(1, current)
        })

        const updateSort = (column) => {
            orderColumn.value = column;
            orderDirection.value = (orderDirection.value === 'asc' ? 'desc' : 'asc')
            getPosts(1, selectedCategory.value, orderColumn.value, orderDirection.value);
        }

        const destroy = (id) => {
            if (confirm('Are you sure?')) {
                Inertia.delete(route('posts.destroy',id))
            }
        }

        return {
            posts,
            getPosts,
            categories,
            selectedCategory,
            orderColumn,
            orderDirection,
            updateSort,
            destroy
        }
    }
}
</script>
    
<template>
    <Head>
        <title>Posts</title>
    </Head>
    <AppLayout>
        <Link v-if="permissions.posts_manage"  :href="route('posts.create')"
            class=" uppercase border md:w-16 text-xs  rounded-lg bg-blue-500  text-white p-2 flex mb-4 font-semibold text-gray-600  on hover:bg-blue-800">Create</Link>
        <div class="mb-4 w-1/4">
            <select
                v-model="selectedCategory"
                class="block mt-1 w-full"
            >
                <option value="" selected>-- Select --</option>
                <option v-for="category in categories" :value="category.id">{{ category.name }}</option>
            </select>
        </div>
        <div class="min-w-full align-middle">
            <table class="min-w-full divide-y divide-gray-200 border">
                <thead>
                <tr>
                    <th class="px-6 py-3 bg-gray-50 text-left">
                        <div class="flex flex-row items-center justify-between cursor-pointer"
                            @click="updateSort('id')"
                        >
                            <div class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                                :class="{'font-bold text-blue-600': orderColumn === 'id' }"
                            >
                                ID
                            </div>
                            <div class="select-none">
                                <span :class="{
                                    'text-blue-600': orderDirection === 'asc' && orderColumn === 'id',
                                    'hidden': orderDirection !== '' && orderDirection !== 'asc' && orderColumn === 'id'
                                }">&uarr;</span>

                                <span :class="{
                                    'text-blue-600': orderDirection === 'desc' && orderColumn === 'id',
                                    'hidden': orderDirection !== '' && orderDirection !== 'desc' && orderColumn === 'id'
                                }">&darr;</span>
                            </div>
                        </div>
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-left">
                        <div class="flex flex-row items-center justify-between cursor-pointer"
                            @click="updateSort('title')"
                        >
                            <div class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                                :class="{'font-bold text-blue-600': orderColumn === 'title' }"
                            >
                                Title
                            </div>
                            <div class="select-none">
                                <span :class="{
                                    'text-blue-600': orderDirection === 'asc' && orderColumn === 'title',
                                    'hidden': orderDirection !== '' && orderDirection !== 'asc' && orderColumn === 'titile'
                                }">&uarr;</span>

                                <span :class="{
                                    'text-blue-600': orderDirection === 'desc' && orderColumn === 'title',
                                    'hidden': orderDirection !== '' && orderDirection !== 'desc' && orderColumn === 'title'
                                }">&darr;</span>
                            </div>
                        </div>
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-left">
                        <span class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Category</span>
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-left">
                        <span class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Content</span>
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-left">
                        <div class="flex flex-row items-center justify-between cursor-pointer"
                            @click="updateSort('created_at')"
                        >
                            <div class="text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                                :class="{'font-bold text-blue-600': orderColumn === 'created_at' }"
                            >
                                Created at
                            </div>
                            <div class="select-none">
                                <span :class="{
                                    'text-blue-600': orderDirection === 'asc' && orderColumn === 'created_at',
                                    'hidden': orderDirection !== '' && orderDirection !== 'asc' && orderColumn === 'created_at'
                                }">&uarr;</span>

                                <span :class="{
                                    'text-blue-600': orderDirection === 'desc' && orderColumn === 'created_at',
                                    'hidden': orderDirection !== '' && orderDirection !== 'desc' && orderColumn === 'created_at'
                                }">&darr;</span>
                            </div>
                        </div>
                    </th>
                    <th class="px-6 py-3 bg-gray-50 text-left">
                    </th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200 divide-solid">
                <tr v-for="post in posts.data">
                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                        {{ post.id }}
                    </td>
                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                        {{ post.title }}
                    </td>
                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                        {{ post.category }}
                    </td>
                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                        {{ post.content }}
                    </td>
                    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                        {{ post.created_at }}
                    </td>
                    <td v-if="permissions.posts_manage" class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                        <button
                        type="button"
                        @click="destroy(post.id)"
                        class=" inline-block  font-bold text-center uppercase border text-xs rounded-lg bg-red-500 text-white p-4 mb-4 hover:bg-red-800"
                    >
                        Delete
                    </button>
                    </td>
                    <td v-if="permissions.posts_manage" class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">
                        <Link
                        :href="route('posts.edit',post.id)"
                        class=" inline-block  font-bold text-center uppercase border text-xs rounded-lg bg-blue-500 text-white p-4 mb-4 hover:bg-blue-800"
                    >
                        Edit
                    </Link>
                    </td>
                </tr>
                </tbody>
            </table>
            <Pagination
                class="mt-3"
                :data="posts"
                @pagination-change-page="getPosts"
            />
        </div>
    </AppLayout>
</template>