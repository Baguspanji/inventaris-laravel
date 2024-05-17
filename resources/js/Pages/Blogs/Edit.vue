<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { useForm, Link, Head } from '@inertiajs/vue3'
import Pagination from '@/Components/Pagination.vue';
import LimitSearch from '@/Components/LimitSearch.vue';


const props = defineProps({
    blog: {
        type: Object,
        default: () => ({}),
    },
});


const form = useForm({
    id: props.blog.id,
    title: props.blog.title,
    slug: props.blog.slug,
    content: props.blog.content,
});

const submit = () => {
    form.put(route("blogs.update", props.blog.id));
};
</script>

<template>
<Head title="Blog Edit" />

    <AdminLayout>
        <div class="col-6 d-none d-sm-block">
            <h3>Blogs Edit</h3>
            <span class="text-muted">List of all blogs</span>
        </div>

        <div class="col-6">
            <Link :href="route('blogs.index')" class="btn btn-primary float-end">Back</Link>
        </div>

        <div class="col-12 mt-4">
            <div class="card">
                <div class="card-body">
                    <form @submit.prevent="submit">
                        <div class="row">
                            <div class="mb-2">
                                <div class="form-group">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" class="form-control" id="title" v-model="form.title">

                                    <div v-if="form.errors.title" class="text-sm text-danger">
                                        {{ form.errors.title }}
                                    </div>
                                </div>
                            </div>

                            <div class="mb-2">
                                <div class="form-group">
                                    <label for="slug" class="form-label">Slug</label>
                                    <input type="text" class="form-control" id="slug" v-model="form.slug">

                                    <div v-if="form.errors.slug" class="text-sm text-danger">
                                        {{ form.errors.slug }}
                                    </div>
                                </div>
                            </div>

                            <div class="mb-2">
                                <div class="form-group">
                                    <label for="slug" class="form-label">Slug</label>
                                    <textarea class="form-control" id="content" v-model="form.content"
                                        rows="4"></textarea>

                                    <div v-if="form.errors.content" class="text-sm text-danger">
                                        {{ form.errors.content }}
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary w-25 float-end" :disabled="form.processing" :class="{ 'disabled': form.processing }">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AdminLayout>

</template>

<style></style>
