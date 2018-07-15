<template>
<span>
<td>{{this.price}}</td> <td>{{'per ' + this.unit}}</td> <td> <input type="number" style="width:50px" v-model="quantity"/> </td><td><button @click="addToCart()">Add</button></td>
</span>
</template>

<script>

export default {

data() {

return {

shopOwner: [],

quantity: 1,

}



},

mounted() {

this.getShopOwner()


},

props:['product', 'unit', 'price', 'id'],

methods: {

getPendingTransactions(){
	
	axios.get('/get/pending/transactions').then(response=>{
		
		response.data.forEach((transactions) => {
		this.$store.commit('add_pending_transactions', transactions)
		
		})
		 
	})
	
},


getShopOwner(){
	
	axios.get('/get/product/owner/' + this.product).then(response=>{
		
		this.shopOwner.push(response.data)
		 
	})
	
},

addToCart() {

if(this.quantity < 1) {

return

}

axios.get('/add/to/cart/' + this.product + '/' + this.id + '/' + this.quantity ).then(response=>{
		
		this.getPendingTransactions()
		
		 
	})

}

}


}


</script>