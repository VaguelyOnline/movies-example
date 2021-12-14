<template>
    <div>
        You are playing the game on {{ difficulty.title }} mode ({{ difficulty.cards }} cards)

        <li>
            score: {{ score }} , position: {{ position }}
        </li>

        <button @click="higherButton()" class="btn btn-primary">higher</button>


        <button @click="lowerButton()" class="btn btn-primary">Lower</button>

    </div>
</template>

<script>
import Button from "../../../vendor/laravel/breeze/stubs/inertia-vue/resources/js/Components/Button.vue"

export default
    components: { Button },t {
    name: "HigherLowerGame",
    props: {
        difficulty: {
            required: true,
            type: Object,
        }
    },
    data() {
        return {
            score: 0,
            deck: [],
            shuffledDeck: [],
            playDeck: [],
            suits: [
                'Hearts',
                'Clubs',
                'Diamonds',
                'Spades'
            ],
            position: 0
        }
    },
    computed: {
        currentCard() {
            return this.playDeck[this.position];
        },
        nextCard() {
            return this.playDeck[this.position + 1];
        }
    },
    mounted() {
        this.deck = this.buildDeck();
        this.shuffledDeck = this.shuffleDeck(this.deck);
        this.playDeck = this.getPlayDeck(this.shuffledDeck);
    },
    methods: {
        // build a complete deck of all cards
        buildDeck() {
            let cards = [];

            this.suits.forEach(suit => cards = cards.concat(this.buildSuit(suit)));

            // this.suits.forEach(suit => {
            //     cards = cards.concat(this.buildSuit(suit));
            // });

            // this.suits.forEach(suit => {
            //     let cardsInSuit = this.buildSuit(suit);
            //     cards = cards.concat(cardsInSuit);
            // });

            // this.suits.forEach(function (suit) {
            //     cards = cards.concat(this.buildSuit(suit))
            // });

            return cards;
        },

        // build all the cards in a given suit
        buildSuit(suit) {
            let cards = [];
            for(let i = 1; i < 14; i++)
                cards.push(this.buildCard(suit, i));

            return cards;
        },

        buildCard(suit, value) {
            return {
                suit: suit,
                value: value
            };
        },

        shuffleDeck(deck) {
            return deck.slice().sort(() => Math.random() - 0.5);
        },

        getPlayDeck(deck) {
            return deck.slice(0, this.difficulty.cards);
        },

        selectButton(choice) {
            this.selectedButton = choice;
        },

        gameOver() {
            this.$emit("gameOver", this.score);
        },

        higherButton() {
            if (this.currentCard > this.nextCard) {
                this.score++,
                this.position++,
            } else {
                this.gameOver;
            }
        },

        lowerButton() {
            if (this.currentCard < this.nextCard) {
                this.score++,
                this.position++,
            } else {
                this.gameOver;
            }
        }
    }
}
</script>

<style scoped></style>
