<template>
    <!-- <Head title="All Locations" /> -->

    <section class="flex flex-col justify-center items-center py-8">
        <h1 class="pb-8 text-3xl">Your Locations</h1>

        <div
            v-for="location in locations"
            :key="location.id"
            class="py-2 px-8 w-full flex justify-between max-w-3xl border-solid border-2 rounded-lg mb-4"
        >
            <a :href="'locations/' + location.id">
                <h2 class="text-xl leading-extra-loose">{{ location.name }}</h2>
            </a>
            <div class="py-2 px-4">
                <a
                    :href="'edit-location/' + location.id"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-4 border-2 border-blue-500 hover:border-blue-700"
                >
                    Edit
                </a>
                <button
                    class="bg-orange-500 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded mr-4"
                    type="submit"
                    @click="deleteLocation(location.id)"
                >
                    Delete
                </button>
            </div>
        </div>
        <a
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-4 border-2 border-blue-500 hover:border-blue-700"
            href="add-location/"
        >
            Add new location
        </a>
    </section>
</template>

<script>
import { Head, router, useForm } from "@inertiajs/vue3";
import { Inertia } from "@inertiajs/inertia";

const form = useForm({});

export default {
    props: {
        locations: {
            required: true,
        },
    },
    methods: {
        deleteLocation(id) {
            if (confirm("Are you sure you want to delete this location?")) {
                this.$inertia.delete(`/delete-location/${id}`);
            }
        },
    },
    data() {
        return {
            form: form,
        };
    },
};
</script>

<style scoped>
a,
button {
    box-sizing: border-box;
}
</style>
