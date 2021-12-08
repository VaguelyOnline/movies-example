<template>
    <div>
        <h1>You are playing the game on {{ difficulty.title }} mode</h1>

        <button @click="gameOver" class="btn btn-primary">
            Demo Game Over screen
        </button>
    </div>
</template>

<script>
export default {
    name: "HigherLowerGame",
    data() {
        return {
            score: 5000,
        };
    },
    props: {
        difficulty: {
            required: true,
            type: Object,
        },
    },
    methods: {
        gameOver() {
            this.$emit("gameOver", this.score);
        },
    },
};
</script>

<style scoped></style>
