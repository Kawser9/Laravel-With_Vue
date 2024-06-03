<template>
    <!-- <div>
        <h1>{{ product.name }}</h1>
        <p>{{ product.description }}</p>
        <p>{{ product.price }}</p>
    </div> -->
    <div class="product">
    <div class="header">
        <div class="back"></div>
    </div>
    <div class="main">
        <div class="left">
        <div hidden id="id">{{ product.id }}</div>
        <h2 id="name">{{ product.name }}</h2>
        <h3 id="price"  @click="handleButtonClick('hello')"  data-price="{{product.price}}" >{{product.price}} </h3>
        <img src="http://www.design.si.it/wp-content/uploads/2018/02/Sedia-di-design-nordico-legno-polipropilene-e-cuscino-grigio.png" alt="" />
        </div>
        <div class="right">
        <p>{{ product.description }}</p>
        <p>In stock. </p>
        <p>
            <span class="fa fa-star yellow"></span>
            <span class="fa fa-star yellow"></span>
            <span class="fa fa-star yellow"></span>
            <span class="fa fa-star yellow"></span>
            <span class="fa fa-star"></span>
            <span>(4.67 - 172 reviews)</span>
        </p>
        <p class="quantity">QUANTITY <span @click="updateTotalPrice('dec')" class="fa fa-angle-left angle"></span><span id="qt">1</span><span @click="updateTotalPrice('inc')" class="fa fa-angle-right angle"></span></p>
            
    </div>
    </div>
    <div class="footer">
        <div class="left">
        <p id="total-price">{{product.price}}</p>
        </div>
        <div class="right">
        <button class="btn btn-secondary"><p @click="addToCard()">Add to Cart</p></button>
        </div>
    </div>
    </div>
</template>

<script>
    import axios from 'axios';

    export default 
    {
        data() 
        {
            return {
            product: {},
            addToCardData: [],
            }
        },
        async created() 
        {
            try {
            const response = await axios.get(`/api/products/${this.$route.params.id}`);
            this.product = response.data;
            
            // console.log(this.product);
            } catch (error) {
            console.error(error);
            }
        },
            mounted() 
            {
                // console.log('new');
                // console.log('sting' + document.getElementById('price').textContent);

                // Additional logic you may want to run after the component has been mounted
                // Get the quantity element
                var quantityElement = document.getElementById('qt');
                var priceElement = document.getElementById('price');
                

                // Get the angle-left and angle-right buttons
                var angleLeftButton = document.querySelector('.fa-angle-left');
                var angleRightButton = document.querySelector('.fa-angle-right');

                // Initialize the initial quantity
                var quantity = parseInt(quantityElement.innerText);
                const price = parseInt(priceElement.innerText);
                // setTimeout(() => {
                //     console.log(document.getElementById('price').textContent);

                // },0.2000);
        
                // console.log(document.getElementById('price').textContent);
                // Function to update the quantity
                function updateQuantity(change) {
                    quantity += change;
                    quantityElement.innerText = quantity;
                }

                // Event listener for the angle-left button
                angleLeftButton.addEventListener('click', function() {
                    if (quantity > 1) {
                        updateQuantity(-1); // Decrease the quantity by 1
                    }
                });

                // Event listener for the angle-right button
                angleRightButton.addEventListener('click', function() {
                    updateQuantity(1); // Increase the quantity by 1
                });
            },
                methods:{
                    handleButtonClick(elem){
                        console.log(elem);
                        console.log(document.getElementById('price').textContent);
                    },
                    calculateTotalPrice() {
                        var quantityElement = document.getElementById('qt');
                        var priceElement = document.getElementById('price');
                        var totalPriceElement = document.getElementById('total-price');
                        var quantity = parseInt(quantityElement.textContent);
                        const price = parseInt(priceElement.innerText);
                        var totalPrice = quantity * price;
                        totalPriceElement.innerText = totalPrice;
                        return { quantity, price, totalPrice };
                    },
                    updateTotalPrice(data){
                        var quantityElement = document.getElementById('qt');
                        var quantity = parseInt(quantityElement.textContent);

                        if(data == 'inc'){
                            quantity += 1;
                        }
                        else if(data == 'dec'){
                            quantity -= 1;
                        }
                        var priceElement = document.getElementById('price');
                        var totalPriceElement = document.getElementById('total-price');
                        const price = parseInt(priceElement.innerText);
                        var totalPrice = quantity * price;
                        totalPriceElement.innerText = totalPrice;
                        // console.log(quantity);
                        // console.log(price);
                        // console.log(totalPrice);
                    },

                    // async addToCard(){
                    //     var { quantity, price, totalPrice } = this.calculateTotalPrice();
                    //     var productId = document.getElementById('id').innerText;
                    //     var name = document.getElementById('name').innerText;
                    //     this.productId = productId;
                    //     this.name = name;
                    //     this.quantity = quantity;
                    //     this.price = price;
                    //     this.totalPrice = totalPrice;
                    //     await axios.post('/api/add-to-cart', this.addToCardData);
                    //     console.log(this.addToCardData);
                    // }

                    async addToCard(){
                        var { quantity, price, totalPrice } = this.calculateTotalPrice();
                        var productId = document.getElementById('id').innerText;
                        var name = document.getElementById('name').innerText;
                        this.addToCardData = {productId, name, quantity, price, totalPrice};
                        await axios.post('/api/add-to-cart', this.addToCardData);
                        setTimeout(() => {
                            console.log('Timeout executed');
                            alert('Product added to cart successfully!');
                        }, 1000);
                        // console.log(this.addToCardData);
                    }

                    // async addToCart() {
                    // var { quantity, price, totalPrice } = this.calculateTotalPrice();
                    // var productId = document.getElementById('id').innerText;
                    // var name = document.getElementById('name').innerText;
                    // this.addToCartData = { productId, name, quantity, price, totalPrice };

                    // try {
                    //     const response = await axios.post('/api/ ', this.addToCartData);
                    //     // Handle the successful response here, e.g., updating the UI or notifying the user
                    //     console.log(response.data);
                    // } catch (error) {
                    //     // Handle the error response here
                    //     console.error('Error adding to cart:', error.response.data);
                    // }

                    // console.log(this.addToCartData);
                    // }
                }
    }
</script>

<style>
    @import url(https://fonts.googleapis.com/css?family=Montserrat:400,700);
    @import url(https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css);

    /* //$senape: #bcbd31;
    $senape:rgb(71, 190, 115);
    $giallo:rgb(254,203,108);

    $cubicBounce:cubic-bezier(0.68, -0.55, 0.265, 1.55); */

    body{
    background:linear-gradient(to top, rgba(100,50,50,0.6), rgba(0,0,0,0.8)),url(https://www.atrafloor.com/app/uploads/2017/01/camo-camouflage-pattern-flooring-grey.jpg);
    background-size:cover;
    min-height:100vh;
    font-family: 'Montserrat', sans-serif;
    }

    a {
    text-decoration:none;
    color: #3399ff;
    }

    #qt{
    color:rgb(153,153,153);
    }

    p{
    .fa[class~=angle]{
        font-size:1.3rem;
        position:relative;
        top: 0.15rem;
        margin:0 20px;
        cursor: pointer;
        color:rgb(216,216,216);
        transition:all .5s;
        &:hover{
        color:$senape;
        }
    }
    }

    .yellow{
    color: $giallo;
    }
    .product{
    height:500px;
    width:640px;
    background:white;
    position:relative;
    left:calc(50% - 300px);
    margin-top:calc(50vh - 250px);
    &.action{
        animation: bounce 1s $cubicBounce infinite;
    }
    .header{
        height:40px;
        position:relative;
        padding:20px;
        .back{
        position:relative;
        width:0px;
        height:0px;
        border-top: 30px solid $senape;
        border-bottom: 30px solid transparent;
        border-left: 30px solid $senape;
        border-right: 30px solid transparent;
        &:before{
            content:"←";
            position:absolute;
            color:rgba(255,255,255,0.9);
            font-size:1.3rem;
            font-weight:bold;
            top:-22px;
            left:-22px;
        }
        }
    }
    .main{
        padding:0 30px;
        box-sizing: border-box;
        .quantity{
        margin-top:40px;
        color: #333;
        }
        h1{
        font-size:4.5rem;
        -webkit-margin-before: 0;
        -webkit-margin-after: 0;
        margin: 0 -5px -15px;
        color:#232e3a;
        }
        h2{
        color:#999999;
        -webkit-margin-before: 0;
        -webkit-margin-after: 0;
        margin: 0 0;
        text-transform:uppercase;
        }
        h3{
        color:#232e3a;
        margin:0;
        }
        img{
        max-width:90%;
        margin-left:25px;
        }
        .left,
        .right{
        width:40%;
        padding: 0 calc(5% - 1px);
        }
        .right{
        color:#999;
        font-size:.78rem;
        line-height: 1.5;
        }
    }
    .footer{
        position:absolute;
        bottom:0;
        padding:5px 40px 5px 0;
        width:calc(90% - 40px);
        left:10%;
        border-top: 1px solid #ccc;
        .left{
        p:before{
            content:"Total Price";
            text-transform:uppercase;
            font-size:.6rem;
            color:black;
            position:absolute;
            top:-12px;
            width:200%;
        }
        }
        p{
        color:$senape;
        position:relative;
        font-size:1.5rem;
        }
    }
    }

    .left{
    float:left;
    }

    .right{
    float:right;
    }

    @keyframes bounce{
    50%{
        transform: translateX(10px);
    }
    }
</style>