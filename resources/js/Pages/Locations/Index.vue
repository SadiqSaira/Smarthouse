<template>
    <h1>Welcome to our app</h1>
    {{ console.log(locations) }}

    <article v-for="location in locations" :key="location.id">
        {{ console.log(location.name) }}
        {{ location.name }}
    </article>
</template>

<script>
export default {
    props: {
        locations: {
            required: true,
        },
    },
    data() {
        return {};
    },
};
</script>
