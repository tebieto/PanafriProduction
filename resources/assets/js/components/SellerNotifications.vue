<template>

	<div>
	
	<span v-if="bid>0" id="remove-contact" @click="cancelTransaction()" class="glyphicon glyphicon-remove"></span>
	<user v-if="bid>0" :pname="pname" :pimage="pimage"  :bid="bid"></user>
	<audio id="timer-alert"  src="/storage/audios/definite.mp3"></audio>
	
	</div>

</template>


<script>

export default {

data() {

return {

pending:false,
cancelled:false,
accepted:false,
pname:"",
pimage:"",
bid:0,
active: false,


}


},

mounted() {

this.listen()


},

props: ['id'],

methods: {

listen() {

	Echo.private('App.User.' + this.id)
	.notification( (notification) => {
	if(this.active==true) {return}
	if(notification.status==0) {return}
	this.active=true
	this.getRecentTransaction(notification.uid)
	this.getBuyerPendingTransactions()
	this.getBuyerActiveTransactions()
	this.getSellerActiveTransactions()
	this.getBuyerChats()
	this.getSellerChats()
	var audio = document.getElementById('seller_audio')
	audio.play();
	})
	
	

},

cancelTransaction() {

this.$store.commit('cancel_transaction')
this.bid=0;
this.active=false;

},

getRecentTransaction(bid) {

	axios.get('/get/recent/transaction/' +bid).then(response=>{
		
		this.pname=response.data.product.name
		this.pimage=response.data.product.image
		this.bid= bid
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



},




}

</script>