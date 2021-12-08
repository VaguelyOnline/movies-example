<template>
    <div>
        <game-welcome v-if="state == 'welcome'" @play="onPlay" />

        <higher-lower-game
            :difficulty="difficulty"
            v-if="state == 'game'"
            @gameOver="onGameOver"
        />

        <game-over
            :score="score"
            v-if="state == 'over'"
            @welcome="onWelcome"
            @playAgain="onPlayAgain"
        />
    </div>
</template>

<script>
import GameWelcome from "./GameWelcome";
import HigherLowerGame from "./HigherLowerGame";
import GameOver from "./GameOver";
export default {
    name: "HigherLower",
    components: { GameOver, HigherLowerGame, GameWelcome },
    data() {
        return {
            state: "",
            difficulty: null,
            score: 0,
        };
    },
    mounted() {
        this.setState("welcome");
    },

    methods: {
        onPlay(difficulty) {
            this.difficulty = difficulty;

            // advance to the game - set the difficulty game
            this.setState("game");
        },

        setState(newState) {
            this.state = newState;
        },

        onGameOver(score) {
            console.log(score);
            this.score = score;
            this.setState("over");
        },

        onWelcome() {
            this.setState("welcome");
        },

        onPlayAgain() {
            this.setState("game");
        },
    },
};
</script>

<style scoped></style>
