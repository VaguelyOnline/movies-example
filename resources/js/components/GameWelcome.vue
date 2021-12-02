<template>
    <div class="text-center">
        <h1 class="mt-5">Welcome to the Higher / Lower Game</h1>
        <h4>Choose your difficulty</h4>

        <div class="row mt-5">

            <div class="col" v-for="difficulty in difficulties">

                <difficulty-select
                    @nathpanic="selectDifficulty(difficulty)"
                    :classes="getClasses(difficulty)"
                    :title="difficulty.title"
                    :description="difficulty.description"
                ></difficulty-select>

            </div>

        </div>

        <button @click="play" :disabled="!selectedDifficulty" class="mt-5 btn btn-outline-primary btn-lg">
            Play
        </button>
    </div>
</template>

<script>
import DifficultySelect from "./widgets/DifficultySelect";
export default {
    name: "GameWelcome",
    components: {DifficultySelect},
    data() {
        return {
            difficulties: [{
                title: 'Easy',
                description: 'Simple enough for a noob like you!',
                context: 'bg-info',
                cards: 5
            }, {
                title: 'Medium',
                description: 'Fancy a bit of a challenge?',
                context: 'bg-primary',
                cards: 15
            }, {
                title: 'Hard',
                description: 'Wow - you must like pain!',
                context: 'bg-danger',
                cards: 52
            }],

            // Track the currently selected difficulty
            selectedDifficulty: null
        }
    },
    methods: {
        selectDifficulty(difficulty) {
            this.selectedDifficulty = difficulty;
        },

        isSelected(difficulty) {
            return this.selectedDifficulty == difficulty;
        },

        getClasses(difficulty) {
            let classes = {};
            classes['selected'] = this.isSelected(difficulty);
            classes[difficulty.context] = true;

            return classes;
        },

        play() {
            this.$emit('play', this.selectedDifficulty);
        }
    }
}
</script>

<style scoped>
    .selected {
        box-shadow: 0px 0px 10px 6px #7457ad
    }
</style>
