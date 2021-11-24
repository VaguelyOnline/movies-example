require('./bootstrap');

require('alpinejs');

import HigherLower from "./components/HigherLower";

new Vue({
    el: '#game',
    components: {
        HigherLower
    }
});

