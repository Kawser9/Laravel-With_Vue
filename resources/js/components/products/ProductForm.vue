<template>
    <div>
      <router-link to="/products" class="btn btn-danger">Back</router-link>
      <h2 v-if="isNewProduct">Add Product</h2>
      <h2 v-else>Edit Product</h2>
      <form @submit.prevent="submitForm">
        <div class="mb-3">
          <label for="name" class="form-label">Name:</label>
          <input class="form-control" type="text" id="name" v-model="product.name" required />
        </div>
        <div class="mb-3">
          <label for="description" class="form-label">Description:</label>
          <textarea class="form-control" id="description" v-model="product.description" required></textarea>
        </div>
        <div class="mb-3">
          <label for="category_id" class="form-label">Category:</label>
          <select class="form-control" id="category_id" v-model="product.category_id" required>
            <option disabled value="">Please select one</option>
            <option v-for="category in categories" :key="category.id" :value="category.id">{{ category.name }}</option>
          </select>
        </div>
        <div class="mb-3">
          <label for="price" class="form-label">Price:</label>
          <input class="form-control" type="number" id="price" v-model="product.price" required />
        </div>
        <button type="submit" v-if="isNewProduct" class="btn btn-primary">Add Product</button>
        <button type="submit" v-else class="btn btn-primary">Update Product</button>
      </form>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        product: {
          name: '',
          description: '',
          category_id: '',
          price: '',
        },
        categories: [],
      }
    },
    computed: {
      isNewProduct() {
        return !this.$route.path.includes('edit');
      }
    },
    async created() {
      await this.fetchCategories();
      if (!this.isNewProduct) {
        await this.fetchProduct();
      }
    },
    methods: {
      async fetchCategories() {
        try {
          const response = await axios.get('/api/categories');
          this.categories = response.data;
        } catch (error) {
          console.error(error);
          // Handle error fetching categories
        }
      },
      async fetchProduct() {
        try {
          const response = await axios.get(`/api/products/${this.$route.params.id}`);
          this.product = response.data;
        } catch (error) {
          console.error(error);
          // Handle error fetching product
        }
      },
      async submitForm() {
        try {
          if (this.isNewProduct) {
            await axios.post('/api/products', this.product);
          } else {
            await axios.put(`/api/products/${this.$route.params.id}`, this.product);
          }
          this.$router.push('/products');
        } catch (error) {
          console.error(error);
          // Handle form submission error
        }
      }
    }
  }
  </script>
  