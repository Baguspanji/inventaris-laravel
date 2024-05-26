<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
});
</script>

<template>
    <Head title="Dashboard" />

    <AdminLayout>
        <div class="col-auto d-none d-sm-block">
            <h3>Dashboard</h3>
        </div>
    </AdminLayout>

</template>

<style></style>
