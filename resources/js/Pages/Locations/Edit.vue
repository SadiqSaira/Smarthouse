<template>
    <Head title="Edit location" />
    <h1>Edit {{ location.name }}</h1>

    <form @submit.prevent="form.post(`/locations`)" method="post">
        <label for="location-name">Change location name:</label>
        <input
            id="location-name"
            v-model="form.name"
            type="text"
            :placeholder="location.name"
        />

        <label for="location_address">Change location name:</label>
        <input
            id="location_address"
            v-model="form.address"
            type="text"
            :placeholder="location.address"
        />

        <button type="submit">Submit</button>
    </form>
</template>

<script>
import { Head, useForm } from "@inertiajs/vue3";

const form = useForm({
    name: "",
    address: "",
});

export default {
    props: {
        location: {
            required: true,
        },
    },
    data() {
        return {
            form: form,
        };
    },
};
</script>
