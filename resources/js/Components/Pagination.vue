<script setup>
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    data: {
        type: Object,
        default: () => ({}),
    },
});
</script>

<template>
    <div v-if="props.data.links.length > 3" class="pagination">
        <Link v-for="(link, k) in props.data.links" :key="k" class="btn btn-outline-primary btn-sm me-1"
            :class="{ 'active': link.active }" :href="link.url" v-html="link.label" />
    </div>
</template>

<style>
.pagination {
    display: flex;
    justify-content: center;
    margin-top: 10px;
}

.pagination .btn-outline-primary.active {
    color: #fff !important;
}
</style>
