<template>
    <div @click="select" class="card" :class="classes">
        <div class="card-body">
            <h5 class="card-title">{{ title }}</h5>
            <p class="card-text">{{ description }}</p>
            <button class="btn btn-light btn-lg">Select</button>
        </div>
    </div>
</template>

<script>
export default {
    name: "DifficultySelect",
    props: {
        title: {
            required: true,
            type: String,
        },
        description: {
            required: true,
            type: String,
        },
        classes: {
            required: false,
            type: Object,
        },
    },

    methods: {
        select() {
            this.$emit('selected');
        }
    }
}
</script>

<style scoped>
.card:hover {
    cursor: pointer;
}
</style>
