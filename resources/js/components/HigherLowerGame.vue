<template>
    <div class="row" style="padding-top: 25px">
        <div class="card">
            <div class="card-body" style="text-align: center">
                <h5 class="card-title">Higher or Lower Game.</h5>
                <p class="card-text">
                    Difficulty: {{ difficulty.title }} ({{
                        difficulty.cards
                    }}
                    Cards)
                </p>
                <p class="card-text">
                    Current card: {{ currentCard.value }} of
                    {{ currentCard.suit }}
                </p>
                <p class="card-text" v-if="lastCard == undefined">Last card:</p>
                <p class="card-text" v-else>
                    Last card: {{ lastCard.value }} of {{ lastCard.suit }}
                </p>
                <br />
                <br />

                <p class="card-text">Score: {{ this.score }}</p>
                <p class="card-text">
                    Cards Remaining: {{ this.playDeck.length - this.position }}
                </p>
                <p class="card-text"></p>
                <button @click="higherButton" class="btn btn-success">
                    Higher
                </button>
                <button @click="lowerButton" class="btn btn-danger">
                    Lower
                </button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "HigherLowerGame",
    props: {
        difficulty: {
            required: true,
            type: Object,
        },
    },
    data() {
        return {
            score: 0,
            deck: [],
            shuffledDeck: [],
            playDeck: [],
            suits: ["Hearts", "Clubs", "Diamonds", "Spades"],
            position: 0,
        };
    },
    computed: {
        currentCard() {
            if (this.endOfDeck()) {
                this.gameOver();
            } else {
                return this.playDeck[this.position];
            }
        },
        nextCard() {
            return this.playDeck[this.position + 1];
        },
        lastCard() {
            return this.playDeck[this.position - 1];
        },
        /*
        cardsLeft() {
            if (this.position + 1 > this.playDeck.length()) {
                this.gameOver();
            }
        },
        */
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

            this.suits.forEach(
                (suit) => (cards = cards.concat(this.buildSuit(suit)))
            );

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
            for (let i = 1; i < 14; i++) cards.push(this.buildCard(suit, i));

            return cards;
        },

        buildCard(suit, value) {
            return {
                suit: suit,
                value: value,
            };
        },

        shuffleDeck(deck) {
            return deck.slice().sort(() => Math.random() - 0.5);
        },

        getPlayDeck(deck) {
            return deck.slice(0, this.difficulty.cards);
        },

        gameOver() {
            this.$emit("gameOver", this.score);
        },

        endOfDeck() {
            return this.position == this.playDeck.length - 1;
        },

        higherButton() {
            if (this.currentCard.value <= this.nextCard.value) {
                this.score++;
                this.position++;
            } else {
                this.gameOver();
            }
        },

        lowerButton() {
            if (this.currentCard.value >= this.nextCard.value) {
                this.score++;
                this.position++;
            } else {
                this.gameOver();
            }
        },
    },
};
</script>

<style scoped></style>
