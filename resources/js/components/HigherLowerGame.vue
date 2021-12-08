<template>
    <div>
        You are playing the game on {{ difficulty.title }} mode ({{ difficulty.cards }} cards)

        <li v-for="card in playDeck">
            {{ card.value }} of {{ card.suit }}
        </li>
    </div>
</template>

<script>
export default {
    name: "HigherLowerGame",
    props: {
        difficulty: {
            required: true,
            type: Object
        }
    },
    data() {
        return {
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
        },
        nextCard() {
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
        }
    }
}
</script>

<style scoped>

</style>
