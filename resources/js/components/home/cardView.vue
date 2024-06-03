<template>
    <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Price</th>
                <th scope="col">Quantity</th>
                <th scope="col">Tota Price</th>
              </tr>
            </thead>
            <tbody>
                <tr v-for="card in cards" :key="card.id">
                    <td>{{ card.id }}</td>
                    <td>{{ card.price }}</td>
                    <td>{{ card.quantity }}</td>
                    <td>{{ card.totalPrice }}</td>
                </tr>
            </tbody>
            <td> Sub Total : {{ subTotal }}</td>
        </table>
</template>

<script>
import axios from 'axios'

export default {
    name: 'ListNotes',
    data() {
        return {
            cards: [],
            subTotal: 0,
           
        }
    },
    mounted() {
        // console.log('Page mounted');
        this.getListNotes();
    },
    methods: {
        getListNotes() {
            axios.get('/api/card').then(response => {
                this.cards = response.data
                this.subTotal = this.cards.reduce((total, item) => total + item.totalPrice, 0);
                console.log(this.subTotal);
                console.log(this.cards);
            })
        }
    }
}
</script>
