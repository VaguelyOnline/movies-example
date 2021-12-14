<template>
    <div>
        <h1>Game Over</h1>
        <p>{{ completedMessage }} Your score: {{ score }}</p>
        <img
            v-if="scoreIsGood"
            src="https://c.tenor.com/LaZ6HhZb8OEAAAAM/multiplier-9000.gif"
            alt=""
        />
        <button @click="playAgain()" class="btn btn-primary">Play Again</button>
        <button @click="welcome()" class="btn btn-outline-primary">
            Main Menu
        </button>
    </div>
</template>

<script>
export default {
    name: "GameOver",
    props: {
        difficulty: {
            required: true,
            type: Object,
        },
    },
    data() {
        return {};
    },
    computed: {
        scoreIsGood() {
            return this.score == this.difficulty.cards - 1;
        },
        completedMessage() {
            if (this.scoreIsGood) {
                return "Congratulations you win";
            } else {
                return "Better luck next time!";
            }
        },
    },
    props: {
        score: {
            required: true,
            type: Number,
        },
        difficulty: {
            required: true,
            type: Object,
        },
    },

    methods: {
        welcome() {
            this.$emit("welcome");
        },
        playAgain() {
            this.$emit("playAgain");
        },
    },
};
</script>

<style scoped></style>
