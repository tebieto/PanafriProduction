<template>

<div class="transactions" v-if="buyerDetails.length>0">

		<div class="seller-details">
		
		<div style="height: 80px; overflow-y:auto">
		<img class="owner-avatar"  width="50px" height="50px" style="border-radius:50%; margin:10px;" :src="buyerDetails[0].avatar"/>
		
		<div style="margin-top:-50px; margin-left:80px;"><span class="user-name">{{buyerDetails[0].fname}} {{buyerDetails[0].lname}}</span> as Buyer <span class="unread">100</span><div class="start-chat-button">Chat</div> </div>
		
		</div>
		
		<div class="hr"></div>
		
		<div style="height:80px; overflow-y:auto;">
		<h4 style="margin-left:10px;"> {{buyerDetails[0].profile.location}}</h4>
		
		</div>
		
		<div class="hr"></div>
		
		<div style="height:80px; overflow-y:auto;">
		<h4 style="margin-left:10px;">Modify Request</h4>
		
		</div>
		
		
		
		<div style="height:150px; overflow-y:auto;">
		
		<span v-for="transaction in trackedTransactions">
		<img class="product-avatar"  width="50px" height="50px" style="border-radius:5px; margin:10px;" :src="transaction.price.product.image"/>
		
		<span v-if="transaction.quantity==1">
		<span class="pending-product-name">{{transaction.price.product.name}}({{'N' + transaction.price.price + 'x' + transaction.quantity + transaction.price.unit }}) <span style="color:red; cursor:pointer;"  @click="delTransaction(transaction.id, transaction.price.price*transaction.quantity)" v-if="cancelled==false && accepted==false">remove</span></span><br>
		</span>
		<span v-else>
		<span class="pending-product-name">{{transaction.price.product.name}}({{'N' + transaction.price.price + 'x' + transaction.quantity + transaction.price.unit +'s'}}) <span style="color:red; cursor:pointer;" @click="delTransaction(transaction.id, transaction.price.price*transaction.quantity)" v-if="cancelled==false && accepted==false">remove</span></span><br>
		</span>
		</span>	
		</div>
		
		
		
		
		</div>
		
		<div class="hr"></div>
		
		<div style="height:150px; overflow-y:auto;">
		<h4 style="margin-left:10px;">N {{total}} <br> Delivery Fee(N): <input type="number" style="width:80px;" value="0" v-model="delivery"/><br>Total + Delivery = N {{totalAndDelivery}}</h4>
		<span v-if="cancelled==false && accepted==false">
		<button style="margin-left:10px; border:none; color:#fff; background:green; font-weight:bold;" @click="acceptRequest">Accept</button> <button style="margin-left:10px; border:none; color:#000; background:yellow; font-weight:bold;">Finish</button>  <button style="margin-left:10px; border:none; color:#fff; background:red; font-weight:bold;" @click="cancelTransaction()">Decline</button> <button style="margin-left:10px; border:none; color:#fff; background:black; font-weight:bold;">Report</button>
		</span>
		
		<span v-if="cancelled"style="color:red; margin-left:10px;">
		Transaction Cancelled
		</span>
		
		<span v-if="accepted" style="color:green; margin-left:10px;">
		Request accepted
		</span>
		
		</div>
	
		</div>
		</div>
		
</template>

<script>

export default {

props: ['id', 'buyer', 'shop'],

data() {

return {

buyerDetails: [],
trackedTransactions: [],
total: 0,
cancelled: false,
accepted: false,
delivery: 0,
totalAndDelivery:''

}

},

mounted() {

this.getbuyerDetails()
this.getTrackedTransactions()



},

watch:{

delivery() {

 this.totalAndDelivery= this.total + this.delivery

}


},

methods: {

acceptRequest() {
this.accepted=  true
axios.get('/accept/transaction/' + this.id + '/' + this.delivery).then(response=>{


})

},

getbuyerDetails() {

   axios.get('/get/user/details/' + this.buyer).then(response=>{
		
		this.buyerDetails.push(response.data)
		
		})


},

getTrackedTransactions(){
	
	axios.get('/get/tracked/transactions/' + this.id).then(response=>{
		response.data.forEach((tracked)=> {
		if(tracked.price && tracked.price.product && tracked.price.product.status==1) {
		this.trackedTransactions.push(tracked)
		this.total= this.total + tracked.price.price * tracked.quantity
		}
		})
		this.totalAndDelivery= this.total
		if(this.total==0) {
		
		this.cancelTransaction()
		
		}
		 
	})
	
},

cancelTransaction(){
this.cancelled = true
axios.get('/cancel/transaction/' + this.id).then(response=>{

})

},

delTransaction(id, amount) {

var transaction = this.trackedTransactions.find ( t => {
				return t.id === id
				
			})

			
	var index = this.trackedTransactions.indexOf(transaction)
			
	this.trackedTransactions.splice(index, 1)

if(this.total>0) {
this.total = this.total-amount
}

if(this.total==0) {

this.cancelTransaction()

}

axios.get('/delete/transaction/' + id).then(response=>{

})



},


}
}

</script>

<style>

.pending-product-name {
position: relative;
top: -30px;

}

</style>