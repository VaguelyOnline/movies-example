<template>
    <div>
        You are playing the game on {{ difficulty.title }} mode ({{ difficulty.cards }} cards)

        <div class="row">
            <div class="col">
                <button @click="checkHigher" type="button" class="btn btn-outline-secondary">Higher</button>
            </div> 
        </div>

        <div class="row">
            <div class="col">
                <p>{{this.currentCard.value}} of {{this.currentCard.suit}}</p>
            </div> 
        </div>
        
        <div class="row">
            <div class="col">
                <button @click="checkLower" type="button" class="btn btn-outline-secondary">Lower</button>
            </div> 
        </div>

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
            return this.playDeck[this.position+1];
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

        gameOver() {
            this.$emit("gameOver", this.score);
        },

        moveResolver(move){
            if (move) {
                this.postion+=1;
                this.score+=1;
            } else{
                this.gameOver();
            }
        },

        checkHigher() {
            console.log(this.currentCard.value);
            console.log(this.nextCard.value);
            return this.moveResolver(this.currentCard.value < this.nextCard.value);
        },

        checkLower() {
            console.log(this.currentCard.value);
            console.log(this.nextCard.value);
            return this.moveResolver(this.currentCard.value > this.nextCard.value);
        }


    }
}
</script>

<style scoped></style>
