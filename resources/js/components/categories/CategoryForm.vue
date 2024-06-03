<template>
    <div>
      <router-link to="/categories" class="btn btn-danger">Back</router-link>
      <h2 v-if="isNewProduct">Add Category</h2>
      <h2 v-else>Edit Category</h2>
        <form @submit.prevent="submitForm">
          <div class="mb-3">
            <label for="name" class="form-label">Name:</label>
            <input class="form-control" type="text" id="name" v-model="product.name" required />
          </div>
          <div class="mb-3">
            <label for="description" class="form-label">Description:</label>
            <textarea class="form-control" id="description" v-model="product.description" required></textarea>
          </div>
          <button type="submit" v-if="isNewCategory" class="btn btn-primary">Add Category</button>
          <button type="submit" v-else class="btn btn-primary">Update Category</button>
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
          slug: '1',
          status: '1',
          description: '',
        }
      }
    },
    computed: {
      isNewProduct() {
        return !this.$route.path.includes('edit');
      }
    },
    async created() {
      if (!this.isNewCategory) {
        const response = await axios.get(`/api/categories/${this.$route.params.id}`);
        this.product = response.data;
      }
    },
    methods: {
      async submitForm() {
        try {
          if (this.isNewProduct) {
            await axios.post('/api/categories', this.product);
          } else {
            await axios.put(`/api/categories/${this.$route.params.id}`, this.product);
          }
          this.$router.push('/categories');
        } catch (error) {
          console.error(error);
        }
      }
    }
  }
  </script>