<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { useForm, Link, Head } from '@inertiajs/vue3'
import Pagination from '@/Components/Pagination.vue';
import LimitSearch from '@/Components/LimitSearch.vue';


const props = defineProps({
    items: {
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
        form.delete(route('item.destroy', id));
    }
}

let page = props.items.current_page || 1;
let limit = props.filters.limit || 10;

</script>

<template>

    <Head title="Barang" />

    <AdminLayout>
        <div class="col-6 d-none d-sm-block">
            <h3>Barang</h3>
            <span class="text-muted">List of all barang</span>
        </div>

        <div class="col-6">
            <Link :href="route('item.create')" class="btn btn-primary float-end">Tambah Data</Link>
        </div>

        <div class="col-12 mt-4">
            <div class="card">
                <div class="card-body">
                    <LimitSearch :section="props.items" :filters="filters" route="item"/>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped nowrap">
                            <thead class="text-center">
                                <tr>
                                    <th>#</th>
                                    <th>Gambar</th>
                                    <th>Nama</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="item, i in props.items.data" :key="item.id">
                                    <td>{{ limit * (page - 1) + i + 1 }}</td>
                                    <td class="text-center">
                                        <img :src="item.image" alt="image" style="width: 50px; height: 50px;">
                                    </td>
                                    <td>{{ item.name }}</td>
                                    <td class="text-center">{{ item.price }}</td>
                                    <td class="text-center">{{ item.stock }}</td>
                                    <td class="text-center">
                                        <span v-if="item.status" class="badge bg-success">Active</span>
                                        <span v-else class="badge bg-danger">Inactive</span>
                                    </td>
                                    <td class="text-center">
                                        <Link :href="route('item.edit', item.id)" class="btn btn-sm btn-primary"
                                            style="margin-right: 4px;">Edit
                                        </Link>
                                        <button @click="destroy(item.id)" class="btn btn-sm btn-danger">Hapus</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-end">
                        <Pagination :data="props.items" />
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
