<template>
    <section class="flex flex-col justify-center items-center py-8">
        <h1 class="pb-8 text-3xl">
            Your rooms at location:
            <span class="text-blue-500 font-bold">{{ location.name }}</span>
        </h1>

        <AllRooms :rooms="rooms" />
    </section>
</template>

<script>
import AllRooms from "../Rooms/Index.vue";

export default {
    props: {
        location: {
            required: true,
        },
        rooms: {
            required: true,
        },
    },
    components: {
        AllRooms,
    },
};
</script>
