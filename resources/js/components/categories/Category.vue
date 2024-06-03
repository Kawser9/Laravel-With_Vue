<template>
    <div>
        <h5 id="associating-form-text-with-form-controls">Name:</h5>
        <h6>{{ product.name }}</h6>
        <h5 id="associating-form-text-with-form-controls">Description:</h5>
        <p>{{ product.description }}</p>
        <h5 id="associating-form-text-with-form-controls">Price:</h5>
        <p>Price: {{ product.price }}</p>
        <router-link :to="`/products/${product.id}/edit`" class="btn btn-primary">Edit</router-link>
    </div>
</template>

<script>
import axios from 'axios';

export default {
data() {
    return {
    product: {}
    }
},
async created() {
    try {
    const response = await axios.get(`/api/products/${this.$route.params.id}`);
    this.product = response.data;
    } catch (error) {
    console.error(error);
    }
}
}
</script>