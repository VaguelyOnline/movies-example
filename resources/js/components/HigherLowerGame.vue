<template>
    <div>
        <p>
            You are playing the game on {{ difficulty.title }} mode ({{
                difficulty.cards
            }}
            cards)
        </p>

        <p>Score: {{ score }}</p>
        <p>Lives: {{ lives }}</p>
        <p>Card Count: {{ position }}</p>

        <button @click="higherButton">higher</button>
        <p>{{ currentCard }}</p>
        <button @click="lowerButton">Lower</button>
        <br />

        <!-- <li v-for="card in playDeck">{{ card.value }} of {{ card.suit }}</li> -->
        <button class="btn btn-primary" @click="gameOver">
            Game Over Demo
        </button>
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
            lives: 3,
        };
    },
    computed: {
        currentCard() {
            return this.playDeck[this.position];
        },

        nextCard() {
            let nextCard = this.playDeck[this.position + 1];
            if (!nextCard) return false;
            return nextCard;
        },

        // nextCard() {
        //     return this.playDeck[this.position + 1];
        // },

        checkGameOver() {
            if (this.position == this.difficulty.cards) {
                this.gameOver();
            }
        },
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

        higherButton() {
            if (!this.nextCard) this.gameOver();
            if (this.currentCard.value < this.nextCard.value) {
                this.position++;
                this.score++;
            } else if (this.currentCard.value > this.nextCard.value) {
                this.checkScore();
            } else {
                // If cards are the same value skip and don't give score
                this.position++;
            }
        },

        lowerButton() {
            if (!this.nextCard) this.gameOver();
            if (this.currentCard.value > this.nextCard.value) {
                this.position++;
                this.score++;
            } else if (this.currentCard.value < this.nextCard.value) {
                this.checkScore();
            } else {
                // If cards are the same value skip and don't give score
                this.position++;
            }
        },

        checkScore() {
            if (this.lives > 0) {
                this.lives--;
                this.position++;
            } else {
                this.gameOver();
            }
        },
    },
};
</script>

<style scoped></style>
