<template>
    <Head title="All Locations" />
    <h1>Welcome to our app</h1>
    {{ console.log(locations) }}

    <article v-for="location in locations" :key="location.id">
        <div class="flex">
            <h2>{{ location.name }}</h2>
            <a :href="'edit-location/' + location.id" class="btn"> Edit </a>
            <button>Delete</button>
        </div>
    </article>
</template>

<script>
import { Head } from "@inertiajs/vue3";
export default {
    props: {
        locations: {
            required: true,
        },
    },
    data() {},
};
</script>
