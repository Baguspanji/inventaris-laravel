<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { useForm, Link, Head } from '@inertiajs/vue3'
import Pagination from '@/Components/Pagination.vue';
import LimitSearch from '@/Components/LimitSearch.vue';


const props = defineProps({
    blogs: {
        type: Object,
        default: () => ({}),
    },
    filters: {
        type: Object,
        default: () => ({}),
    },
});
const form = useForm({});

function destroy(id) {
    if (confirm("Are you sure you want to Delete")) {
        form.delete(route('blogs.destroy', id));
    }
}

</script>

<template>

    <Head title="Blogs" />

    <AdminLayout>
        <div class="col-6 d-none d-sm-block">
            <h3>Blogs</h3>
            <span class="text-muted">List of all blogs</span>
        </div>

        <div class="col-6">
            <Link :href="route('blogs.create')" class="btn btn-primary float-end">Create Blog</Link>
        </div>

        <div class="col-12 mt-4">
            <div class="card">
                <div class="card-body">
                    <LimitSearch :section="blogs" :filters="filters" />

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped nowrap">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Slug</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="blog in props.blogs.data" :key="blog.id">
                                    <td>{{ blog.id }}</td>
                                    <td>{{ blog.title }}</td>
                                    <td>{{ blog.slug }}</td>
                                    <td>
                                        <Link :href="route('blogs.edit', blog.id)" class="btn btn-sm btn-primary"
                                            style="margin-right: 4px;">Edit
                                        </Link>
                                        <button @click="destroy(blog.id)" class="btn btn-sm btn-danger">Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-end">
                        <Pagination :data="props.blogs" />
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>

</template>

<style>
.nowrap td {
    white-space: nowrap;
}
</style>
