import { createApp } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';

// Import components
import App from './components/App.vue';
import ProductList from './components/products/ProductList.vue';
import ProductForm from './components/products/ProductForm.vue';
import Product from './components/products/Product.vue';

import CategoryList from './components/categories/CategoryList.vue';
import CategoryForm from './components/categories/CategoryForm.vue';
import Category from './components/categories/Category.vue';

import home from './components/home/home.vue';
import singleProduct from './components/home/singleProduct.vue';
import cardView from './components/home/cardView.vue';

const router = createRouter({
    history: createWebHistory(),
    routes: [

        
          

        { path: '/', component: home },
        { path: '/cardView', component: cardView },
        { path: '/singleProducts/:id', component: singleProduct },


        // ...............................................
        // { path: '/products', component: ProductList },
        {
            path: '/products',
            name: 'products',
            component: () => ProductList,
            meta: {
                requiresAuth: false,
            }
        },
        { path: '/products/create', component: ProductForm },
        { path: '/products/:id', component: Product },
        { path: '/products/:id/edit', component: ProductForm },


        // ...............................................
        // { path: '/categories', component: CategoryList },
        {
            path: '/categories',
            name: 'categories',
            component: () => CategoryList,
            meta: {
                requiresAuth: false,
            }
        },  
        { path: '/categories/create', component: CategoryForm },
        { path: '/categories/:id', component: Category },
        { path: '/categories/:id/edit', component: CategoryForm },

        
    ]
});

const app = createApp(App);
app.use(router);
app.mount('#app');







/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// import './bootstrap';
// import { createApp } from 'vue';

/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

// const app = createApp({});

// import ExampleComponent from './components/ExampleComponent.vue';
// app.component('example-component', ExampleComponent);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// Object.entries(import.meta.glob('./**/*.vue', { eager: true })).forEach(([path, definition]) => {
//     app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
// });

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */

// app.mount('#app');
