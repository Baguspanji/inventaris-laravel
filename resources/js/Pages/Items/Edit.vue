<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { useForm, Link, Head } from '@inertiajs/vue3'
import { ref } from 'vue';
import axios from 'axios';

const props = defineProps({
    item: {
        type: Object,
        default: () => ({}),
    },
});

const form = useForm({
    name: props.item.name,
    description: props.item.description,
    price: props.item.price,
    stock: props.item.stock,
    status: props.item.status === 1 ? true : false,
    image: props.item.image,
});

const file = ref(null)

const submit = () => {
    console.log(form);
    form.put(route("item.update", props.item.id));
};

const previewImage = async () => {
    const fileUpload = file.value.files[0];

    if (fileUpload) {
        const reader = new FileReader();

        // reader.onload = (e) => {
        //     form.image = e.target.result;
        // };

        reader.readAsDataURL(fileUpload);
    }

    // console.log(fileUpload);
    const formData = new FormData();
    formData.append("file", fileUpload);
    formData.append("_token", TOKEN);
    formData.append("type", 'item');

    try {
        const response = await axios.post(route('upload'), formData, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        });

        if (response.status === 200) {
            form.image = response.data.data;
        }

        console.log(response.data);
    } catch (error) {
        console.log(error);
    }
};

</script>

<template>

    <Head title="Barang Tambah Data" />

    <AdminLayout>
        <div class="col-6 d-none d-sm-block">
            <h3>Barang Tambah Data</h3>
            <span class="text-muted">List of all barang</span>
        </div>

        <div class="col-6">
            <Link :href="route('item.index')" class="btn btn-primary float-end">Kembali</Link>
        </div>

        <div class="col-12 mt-4">
            <div class="card">
                <div class="card-body">
                    <form @submit.prevent="submit">
                        <div class="row">
                            <div class="mb-2">
                                <div class="form-group">
                                    <label for="name" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="name" v-model="form.name">

                                    <div v-if="form.errors.name" class="text-sm text-danger">
                                        {{ form.errors.name }}
                                    </div>
                                </div>
                            </div>

                            <div class="mb-2">
                                <div class="form-group">
                                    <label for="description" class="form-label">Deskripsi</label>
                                    <textarea class="form-control" id="description" v-model="form.description"
                                        rows="4"></textarea>

                                    <div v-if="form.errors.description" class="text-sm text-danger">
                                        {{ form.errors.description }}
                                    </div>
                                </div>
                            </div>

                            <div class="mb-2 row">
                                <div class="form-group col-12 col-md-6">
                                    <label for="price" class="form-label">Harga</label>
                                    <input type="number" class="form-control" id="price" v-model="form.price">

                                    <div v-if="form.errors.price" class="text-sm text-danger">
                                        {{ form.errors.price }}
                                    </div>
                                </div>
                                <div class="form-group col-12 col-md-6">
                                    <label for="stock" class="form-label">Stok</label>
                                    <input type="number" class="form-control" id="stock" v-model="form.stock">

                                    <div v-if="form.errors.stock" class="text-sm text-danger">
                                        {{ form.errors.stock }}
                                    </div>
                                </div>
                            </div>

                            <div class="my-2">
                                <div class="form-group">
                                    <label for="status" class="form-label-status"
                                        style="width: 100%; margin-bottom: 4px;">Status</label>
                                    <input type="checkbox" class="form-check-input" id="status" v-model="form.status">
                                    <label class="form-check" for="status"></label>

                                    <div v-if="form.errors.status" class="text-sm text-danger">
                                        {{ form.errors.status }}
                                    </div>
                                </div>
                            </div>

                            <div class="my-2">
                                <div class="form-group">
                                    <!-- upload image -->
                                    <label for="image" class="form-label">Gambar</label>
                                    <input type="file" class="form-control" id="image" accept="image/*" ref="file"
                                        v-on:change="previewImage()" style="padding: 0.375rem 0.75rem;" capture />

                                    <div class="mt-2" v-if="form.image">
                                        <img :src="form.image" alt="image" style="width: 120px;">
                                    </div>

                                    <div v-if="form.errors.image" class="text-sm text-danger">
                                        {{ form.errors.image }}
                                    </div>
                                </div>
                            </div>


                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary w-25 float-end">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AdminLayout>

</template>

<style>
/* checkbox status like toggle */
input[type="checkbox"] {
    display: none;
}

input[type="checkbox"]+label {
    cursor: pointer;
    display: inline-block;
    width: 50px;
    height: 24px;
    background-color: #ddd;
    border-radius: 15px;
    position: relative;
}

input[type="checkbox"]+label::before {
    content: "";
    display: block;
    width: 20px;
    height: 20px;
    background-color: #fff;
    border-radius: 50%;
    position: absolute;
    top: 2px;
    left: 2px;
    transition: 0.3s;
}

input[type="checkbox"]:checked+label {
    background-color: #0d6efd;
}

input[type="checkbox"]:checked+label::before {
    left: 28px;
}

/* end checkbox status like toggle */
</style>
