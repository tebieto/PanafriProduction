<template>

	<div>
	
	
	</div>

</template>


<script>

export default {

mounted() {



this.listen()


},

props: ['id'],

methods: {

acceptTransaction() {

this.$store.commit('accept_transaction')


},

listen() {

	Echo.private('App.User.' + this.id)
	.notification( (notification) => {
	if(notification.status==1) {return}
	if(notification.ntype==3) {
	this.acceptTransaction()
	}
	this.getBuyerPendingTransactions()
	this.getBuyerActiveTransactions()
	this.getSellerActiveTransactions()
	this.getBuyerChats()
	this.getSellerChats()
	
	var audio = document.getElementById('buyer_audio')
	audio.play();
	})
	
	

},

getBuyerPendingTransactions(){
	
	axios.get('/get/pending/transactions').then(response=>{
		
		response.data.forEach((transactions) => {
		this.$store.commit('add_pending_transactions', transactions)
		
		})
		 
	})
	
},

getBuyerActiveTransactions(){
	
	axios.get('/get/buyer/active/transactions').then(response=>{
		
		response.data.forEach((transactions) => {
		this.$store.commit('add_buyer_active_transactions', transactions)
		
		})
		 
	})
	
},

getSellerActiveTransactions(){
	
	axios.get('/get/seller/active/transactions').then(response=>{
		
		response.data.forEach((transactions) => {
		this.$store.commit('add_seller_active_transactions', transactions)
		
		})
		 
	})
	
},


getBuyerChats(){
	
	axios.get('/get/buyer/chats').then(response=>{
		
		response.data.forEach((chat) => {
		this.$store.commit('add_buyer_chats', chat)
		
		})
		 
	})
	
},

getSellerChats(){
	
	axios.get('/get/seller/chats').then(response=>{
		
		response.data.forEach((chat) => {
		this.$store.commit('add_seller_chats', chat)
		
		})
		 
	})
	
},



}


}

</script>