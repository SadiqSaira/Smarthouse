<template>
    <section class="flex flex-col justify-center items-center py-8 w-full">
        <div
            v-for="room in rooms"
            :key="room.id"
            class="py-2 px-8 w-full flex justify-between max-w-3xl border-solid border-2 rounded-lg mb-4"
        >
            <h2 class="text-xl leading-extra-loose">{{ room.name }}</h2>
            <div class="py-2 px-4">
                <a
                    :href="'edit-location?id=' + room.id"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-4 border-2 border-blue-500 hover:border-blue-700"
                >
                    Edit
                </a>
                <button
                    class="bg-orange-500 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded mr-4"
                    @click="deleteRoom(room.id)"
                >
                    Delete
                </button>
            </div>
        </div>
        <a
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-4 border-2 border-blue-500 hover:border-blue-700"
            href="add-room/"
        >
            Add new room
        </a>
    </section>
</template>

<script>
import { Head } from "@inertiajs/vue3";

export default {
    name: "AllRooms",
    props: {
        rooms: {
            required: true,
        },
    },
    methods: {
        deleteRoom(id) {
            if (confirm("Are you sure you want to delete this room?")) {
                this.$inertia.delete(`/delete-room/${id}`);
            }
        },
    },
};
</script>

<style scoped>
a,
button {
    box-sizing: border-box;
}
</style>
