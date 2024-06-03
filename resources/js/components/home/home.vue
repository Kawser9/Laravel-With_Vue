<template>
    <div>
        <h1>Home</h1>
        <div class="containerr">
        <div v-for="product in products " :key="product.id" class="test">
            <router-link :to="`/singleProducts/${product.id}`">
                <img src="https://i.pinimg.com/236x/5f/b4/d0/5fb4d05431e64e17fa8d7ae3040657f3.jpg" />
                <div class="content">{{ product.name }}</div>
            </router-link>
                <div class="content"> Category: {{ product.category.name }}</div>
                <p>Details: {{ product.description }}</p>
                <p>{{ product.price }} BDT</p>
                <a style="margin-right: 10px;" href="" class="btn btn-primary">Add to cart</a>
                <router-link :to="`/singleProducts/${product.id}`" class="btn btn-info">View</router-link>
            
        </div>
        </div>
    </div>
</template>

<script>   
import axios from 'axios';
export default {
    data() {
        return {
        products: []
        }
    },
    async created() {
        try {
        const response = await axios.get('/api/products');
        this.products = response.data;
        } catch (error) {
        console.error(error);
        }
    },
}
</script>
<style>
    .test {
    margin: 24px;
    width: 280px;
    border-radius: 6px;
    cursor: pointer;
    transition-duration: 0.25s;
    }
    .test:hover {
    background-color: var(--backgroundColor);
    box-shadow: var(--boxShadow);
    }
    .containerr {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    }
    img {
    width: 280px;
    height: 155px;
    object-fit: cover;
    border-radius: 12px;
    }
    .content {
    margin-top: 6px;
    }

</style>