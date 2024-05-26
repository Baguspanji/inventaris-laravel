<script setup>
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    data: {
        type: Object,
        default: () => ({}),
    },
});

const links = props.data.links || [];
const pageActive = props.data.current_page || 1;
console.log(links);

</script>

<template>
    <div v-if="links.length > 3" class="pagination">
        <div v-for="(link, k) in links" :key="k">
            <Link class="btn btn-outline-primary btn-sm me-1" :class="{ 'active': link.active }" :href="link.url"
                v-html="link.label" />
        </div>
    </div>

    <!-- <div v-else-if="links.length >= 7" class="pagination">
        <div v-for="(link, k) in links" :key="k">
            <Link class="btn btn-outline-primary btn-sm me-1" :href="link.url" v-html="link.label" v-if="k == 0" />
            <Link class="btn btn-outline-primary btn-sm me-1" :href="link.url" v-html="link.label"
                v-else-if="k == links.length - 1" />

            <Link class="btn btn-outline-primary btn-sm me-1" :class="{ 'active': link.active }" :href="link.url"
                v-html="link.label" v-else-if="k == 1" />
            <Link class="btn btn-outline-primary btn-sm me-1" :class="{ 'active': link.active }" :href="link.url"
                v-html="link.label" v-else-if="k == pageActive - 1 && k == 2" />

            <div v-else-if="k == pageActive + 1 && pageActive + 1 < links.length - 3">
                <span class="space-pagination">...</span>
            </div>

            <Link class="btn btn-outline-primary btn-sm me-1" :class="{ 'active': link.active }" :href="link.url"
                v-html="link.label" v-else-if="k == pageActive || k == pageActive - 1 || k == pageActive + 1" />

            <div v-else-if="k == pageActive - 1 && pageActive - 1 > 2">
                <span class="space-pagination">...</span>
            </div>

            <Link class="btn btn-outline-primary btn-sm me-1" :class="{ 'active': link.active }" :href="link.url"
                v-html="link.label" v-else-if="k == pageActive + 1 && k == links.length - 3" />
            <Link class="btn btn-outline-primary btn-sm me-1" :class="{ 'active': link.active }" :href="link.url"
                v-html="link.label" v-else-if="k == links.length - 2" />

        </div>
    </div> -->
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

.space-pagination {
    padding: 5px 10px 5px 6px;
    color: var(--bs-primary);
}
</style>
