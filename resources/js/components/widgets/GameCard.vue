<template>
    <div class="card">
        <div class="card-body">
            <h2>{{ displayValue }} of {{ card.suit }}</h2>
        </div>
    </div>
</template>

<script>
export default {
    name: "GameCard",
    props: {
        card: {
            required: true,
            type: Object,
        },
    },

    computed: {
        displayValue() {
            let value = this.card.value;

            let map = {
                1: "Ace",
                11: "Jack",
                12: "Queen",
                13: "King",
            };

            return map[value] ? map[value] : value;
        },
    },

    suitImage() {
        return "/images/" + this.card.suit + ".png";
    },
};
</script>

<style scoped></style>
