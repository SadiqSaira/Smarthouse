<template>
    <Head title="Edit location" />
    <h1>Edit {{ location.name }}</h1>
</template>

<script>
import { Head } from "@inertiajs/vue3";

export default {
    props: {
        location: {
            required: true,
        },
    },
    data() {},
};
</script>
