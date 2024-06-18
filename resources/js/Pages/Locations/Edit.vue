<template>
    <Head title="Edit location" />

    <section class="flex flex-col justify-center items-center py-8">
        <h1 class="pb-8 text-3xl">
            Edit location:
            <span class="text-blue-500 font-bold">{{ location.name }}</span>
        </h1>

        <form
            @submit.prevent="form.post(`/locations/${location.id}`)"
            method="post"
            class="flex flex-col justify-center items-center py-8 w-full max-w-3xl"
        >
            <label for="location-name" class="w-full"
                >Change location name:</label
            >
            <input
                id="location-name"
                v-model="form.name"
                type="text"
                :placeholder="location.name"
                class="w-full border-inherit border-solid border-2 rounded-lg mb-16 py-4 px-8"
            />

            <label for="location_address" class="w-full"
                >Change location address:</label
            >
            <input
                id="location_address"
                v-model="form.address"
                type="text"
                :placeholder="location.address"
                class="w-full border-inherit border-solid border-2 rounded-lg mb-4 py-4 px-8"
            />

            <button
                type="submit"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-4 border-2 border-blue-500 hover:border-blue-700"
            >
                Submit
            </button>
        </form>
    </section>
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
