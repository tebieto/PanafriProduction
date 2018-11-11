<template>



</template>


<script>

export default {

props: ['id'],
data() {

return {



}


},

mounted() {
this.getUserServices()
this.getUserProducts()
this.getUserDetails()

},

methods: {

getUserProducts() {

axios.get('/get/user/products/' + this.id).then(response=>{
		if (response.data.length== 0) {return}
		response.data.forEach((product) => {
		this.$store.commit('add_user_products', product)
		
		})
		
		})
		


},

getUserServices() {

axios.get('/get/user/services/' + this.id).then(response=>{
		if (response.data.length== 0) {return}
		
		response.data.forEach((service) => {
		this.$store.commit('add_user_services', service)
		
		})
		
		})
		


},

getUserDetails() {

axios.get('/get/user/details/' + this.id).then(response=>{
		
		if (response.data.length== 0) {return}
		this.$store.commit('add_user_details', response.data)
		
		})
		


},


}

}

</script>