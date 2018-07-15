<template>


<div class="items-container">
		<div class="shop-items">
		<div class="item-details">
		<img class="product-avatar"  width="100px" height="100px" style="border-radius:5px; margin:10px;" :src="this.image"/>
		<div class="item-name"><span>{{this.name}}</span></div>
		</div>
		
		
		<div class="item-price-menu">
		<span style="margin:20px; color: red;" v-if="this.online==0">This item is offline</span>
		<table v-else>
		<tr>
		<span>
		<td><b>Price(N)</b></td> <td><b>Unit</b></td> <td><b>Quantity</b></td><td><b>Request</b></td>
		</span>
		</tr>
		
		<tr v-for="price in itemPrices">
		<buy-item :price="price.price" :id="price.id" :product="price.product_id" :unit="price.unit"></buy-item>
		</tr>
		
		</table>
		
		</div>
		
		</div>
</div>		
</div>


</template>

<script>

export default {

props: ['image', 'id', 'name', 'store', 'online'],

data() {

return {

itemPrices: [],
shopOwner: [],

}



},

mounted() {
this.getShopOwner()
this.getItemPrices()


},

methods: {

getShopOwner(){
	
	axios.get('/get/item/owner/' + this.store).then(response=>{
		
		this.shopOwner.push(response.data)
		 
	})
	
},

getItemPrices(){

axios.get('/get/item/Prices/' + this.id).then(response=>{
		
		response.data.forEach((price) =>{
		
		this.itemPrices.push(price)
		
		 })
		 
	})


}

},


}


</script>

<style>

.items-container {
display: inline-block;
background: #fff;
height: 400px;
width: 300px;
overflow-y:auto;
margin: 10px;


}

.item-name {

font-weight:bold;
margin-top: -100px;
margin-left: 130px;

}

.item-details{

height: 125px;
overflow-y: auto;

}

.item-price-menu{

border-top: 2px solid red;
margin-top: 5px;
height: 220px;
}

.item-price-menu td {

padding: 5px;

}

.item-price-menu button{

background: green;
color: #fff;


}

</style>