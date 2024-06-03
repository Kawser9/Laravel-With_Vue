<template>
    <div>
        <h2>Category List</h2>
        <router-link to="/categories/create" class="btn btn-primary">Add Category</router-link>
        <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Status</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody>
                <tr v-for="category in categories" :key="category.id">
                    <td>{{ category.id }}</td>
                    <td>{{ category.name }}</td>
                    <td>{{ category.status }}</td>
                    <td>
                      <div class="row gap-3">
                        <router-link :to="`/categories/${category.id}`" class="p-2 col border btn btn-primary">View</router-link>
                        <router-link :to="`/categories/${category.id}/edit`" class="p-2 col border btn btn-success">Edit</router-link>
                        <button @click="deleteProduct(category.id)" type="button" class="p-2 col border btn btn-danger">Delete</button>
                      </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      categories: []
    }
  },
  async created() {
    try {
      const response = await axios.get('/api/categories');
      this.categories = response.data;
    } catch (error) {
      console.error(error);
    }
  },
  methods: {
    async deleteCategory(id) {
      try {
        await axios.delete(`/api/categories/${id}`);
        this.categories = this.categories.filter(category => category.id !== id);
      } catch (error) {
        console.error(error);
      }
    }
  }
}
</script>