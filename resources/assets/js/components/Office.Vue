<template>
<div>
			<div class="office">
			<center>
			
				<h4>Office  {{'#' + this.id}}, {{this.name}}</h4>
			</center>
			</div>
			<div v-for="product in this.products">
			
			<product :id="product.id" :name="product.name" :description="product.description" :status="product.status" :store="this.id" :category="product.category_id" :image="product.image"></product>
			</div>
	
</div>


</template>


<script>

export default {

props:['id', 'name', 'root'],

mounted() {

this.getAuthDetails()
this.getStoreProducts()


},

data() {

return {

authDetails: [],
products: [],




}


},


methods: {


getAuthDetails(){
	
	axios.get(this.root + '/auth/details').then(response=>{
		
		this.authDetails.push(response.data)
	})
	
},

getStoreProducts(){
	
	axios.get(this.root + '/products/store/' + this.id).then(response=>{
		response.data.forEach((product)=> {
		this.products.push(product)
		})
	})
	
},

showProductPrice() {
	
var product = document.getElementById('product-price')

product.classList.remove('hidden')	
},

hideProductPrice() {
	
var product = document.getElementById('product-price')

product.classList.add('hidden')
		
	
},



}

}


</script>