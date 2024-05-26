<script setup>
// emit
import { watch, ref } from 'vue';
import { router } from '@inertiajs/vue3';

const props = defineProps({
    filters: {
        type: Object,
        default: () => ({}),
    },
    route: {
        type: String,
        default: '',
    },
});

let search = ref(props.filters.search);
watch(search, (value) => {
    router.get(
        `/${props.route}`,
        { search: value },
        {
            preserveState: true,
            replace: true,
        }
    );
});

let limit = ref(props.filters.limit || 10);
watch(limit, (value) => {
    router.get(
        `/${props.route}`,
        { limit: value },
        {
            preserveState: true,
            replace: true,
        }
    );
});
</script>

<template>
    <div class="row justify-content-between mb-3">
        <div class="col-4 col-md-1" style="width: 12%;">
            <div class="form-group">
                <select class="form-select" v-model="limit">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>
        </div>

        <div class="col-12 col-md-3">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Search" v-model="search"
                    v-if="!props.filters.search" />
                <div class="input-group" v-if="props.filters.search">
                    <input type="text" class="form-control" placeholder="Search" v-model="search"
                        v-if="props.filters.search" />
                    <button class="btn btn-outline-secondary" @click="search = ''">Clear</button>
                </div>
            </div>
        </div>
    </div>
</template>

<style></style>
