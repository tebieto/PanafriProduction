<template>

<div class="inactive-transactions" v-if="shopDetails.length>0">

		<div class="seller-details">
		
		<div style="height: 80px; overflow-y:auto">
		<img class="owner-avatar"  width="50px" height="50px" style="border-radius:50%; margin:10px;" :src="shopDetails[0].seller.avatar"/>
		
		<div style="margin-top:-50px; margin-left:80px;"><span class="user-name">{{shopDetails[0].seller.fname + ' ' + shopDetails[0].seller.lname }}</span> as Seller <div  v-if="cancelled==false && requested==false"  @click="sendRequest()" class="start-chat-button" style="width:100px;">Send Request</div> </div>
		
		</div>
		
		<div class="hr"></div>
		
		<div style="height:80px; overflow-y:auto;">
		<h4 style="margin-left:10px;">{{shopDetails[0].name + ', ' + shopDetails[0].location.location + ', ' + shopDetails[0].seller.phone }}</h4>
		
		</div>
		
		<div class="hr"></div>
		
		<div style="height:80px; overflow-y:auto;">
		<h4 style="margin-left:10px;">Your Requests</h4>
		
		</div>
		
		
		
		<div style="height:150px; overflow-y:auto;">
		
		<span v-for="transaction in trackedTransactions">
		<img class="product-avatar"  width="50px" height="50px" style="border-radius:5px; margin:10px;" :src="transaction.price.product.image"/>
		
		<span v-if="transaction.quantity==1">
		<span class="pending-product-name">{{transaction.price.product.name}}({{'N' + transaction.price.price + 'x' + transaction.quantity + transaction.price.unit }}) <span style="color:red; cursor:pointer;"  @click="delTransaction(transaction.id, transaction.price.price*transaction.quantity)" v-if="cancelled==false && requested==false">remove</span></span><br>
		</span>
		<span v-else>
		<span class="pending-product-name">{{transaction.price.product.name}}({{'N' + transaction.price.price + 'x' + transaction.quantity + transaction.price.unit +'s'}}) <span style="color:red; cursor:pointer;" @click="delTransaction(transaction.id, transaction.price.price*transaction.quantity)" v-if="cancelled==false && requested==false">remove</span></span><br>
		</span>
		</span>	
		</div>
		
	
		
		<div class="hr"></div>
		
		<div style="height:100px; overflow-y:auto;">
		<h4 style="margin-left:10px;">Total= N{{total}} Delivery Fee: TBD</h4>
		<span v-if="cancelled==false && requested==false">
		<button style="margin-left:10px; border:none; color:#fff; background:green; font-weight:bold;"   @click="sendRequest()" >Request</button>   <button @click="cancelTransaction()" style="margin-left:10px; border:none; color:#fff; background:red; font-weight:bold;">Cancel</button>
		</span>
		<span v-if="cancelled"style="color:red; margin-left:10px;">
		Transaction Cancelled
		</span>
		
		<span v-if="requested" style="color:green; margin-left:10px;">
		Request Sent
		</span>
		</div>
		</div>
		
		
	
		</div>
		</div>
		
</template>

<script>

export default {

props: ['id', 'seller', 'shop'],

mounted() {

this.getShopDetails()
this.getTrackedTransactions()


},

data() {

return {

shopDetails:[],
trackedTransactions: [],
total: 0,
cancelled: false,
requested: false,

}


},

methods: {

sendRequest() {
this.requested=  true

axios.get('/request/transaction/' + this.id).then(response=>{

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

cancelTransaction(){
this.cancelled = true

axios.get('/cancel/transaction/' + this.id).then(response=>{

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
		
		if(this.total==0) {
		
		this.cancelTransaction()
		
		}
		 
	})
	
},

getShopDetails(){
	
	axios.get('/get/shop/details/' + this.shop).then(response=>{
		
		if(response.data.online==0 || response.data.seller.online==0) {
		
		this.cancelTransaction()
		}
		this.shopDetails.push(response.data)

		 
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