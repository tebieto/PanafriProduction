<template>

<div class="call-partner">

<img class="partner-avatar"  width="100px" height="100" :src="partner[0].avatar" :title="partner[0].name" :alt="partner[0].name" v-if="partner.length>0">

<div v-if="partner.length>0" class="partner-name">{{partner[0].name.toUpperCase()}}</div>

<span v-if="cancelled==false && accepted==true" id="phone-icon" class="glyphicon glyphicon-phone"></span>
<div v-if="cancelled==false && accepted==true" class="partner-phone">CALL {{partner[0].phone}}</div>


<img class="product-avatar"  width="100px" height="100" :src="this.pimage" :title="this.pname" :alt="this.pname">
<div v-if="partner.length>0" class="sub-product-name">{{this.pname.toUpperCase()}}</div>

<button class="abutton" v-if="cancelled==false && accepted==false" @click="acceptTransaction()">Accept</button>
<button class="dbutton" v-if="cancelled==false && accepted==false" @click="cancelTransaction()">Decline</button>
<div v-if="cancelled==true" class="connect-message">Transaction cancelled</div>
<div v-if="partner.length>0 && timer>0  && accepted==false && cancelled==false" class="connect-message">{{partner[0].name.toUpperCase()}} REQUESTED {{this.pname.toUpperCase()}}</div>
<div v-if="timer>0 && cancelled==false && accepted==false" class="connect-timer">{{this.timer}}<span style="font-size:15px;">s left</span></div>
</div>

</template>


<script>


export default {

props: ['pname', 'pimage','bid'],

data() {

return {

partner: [],
timer:100,
accepted: false,
cancelled: false,


}


},

mounted() {

this.getPartnerDetails();
this.startTimer()
this.resetCancel();
this.resetAccept();

},

methods: {

resetAccept() {

this.$store.commit('reset_accept')

},

resetCancel() {

this.$store.commit('reset_cancel')

},

acceptTransaction() {

this.accepted=true

var audio = document.getElementById('seller_audio')
	audio.pause();

axios.get('/accept/recent/transaction/' + this.bid).then(response=>{
		

	});

},

cancelTransaction() {

this.cancelled=true

var audio = document.getElementById('seller_audio')
	audio.play();

this.$store.commit('cancel_transaction')

},


getPartnerDetails(){
	
	axios.get('/get/user/details/' + this.bid).then(response=>{

		this.partner.push(response.data)
	})
	
},

startTimer() {

var time= setInterval(this.subTime, 1200)

},

subTime() {
this.cancelled = this.$store.state.cancel
if(this.timer>0 && this.accepted==false && this.cancelled==false) {

var audio = document.getElementById('timer-alert')

audio.play();
	
this.timer= this.timer-1;
} else {

if(this.timer==0) {
this.cancelled=true
}
}

} 


},

computed: {
				
	checkCancel(){
	var cancelled = this.$store.state.cancel
	this.cancelled= cancelled
	return cancelled
	},
	
	}



}


</script>


<style>

.partner-avatar, #phone-icon, .product-avatar{

position: absolute;
top: 25px;
left:5px;
width:100px;
height:100px;
background:#fff;
border:1px solid transparent;
border-radius:50%;


}

.partner-name, .partner-phone, .sub-product-name {
position:absolute;
font-size:20px;
left:115px;
top: 50px;
color:#fff;
}

.partner-phone {

top:350px;
}


.sub-product-name {

top:200px;
}


#phone-icon {

top:325px;
padding-left:15px;
padding-top:15px;
color:#000;
font-size:65px;

}

.product-avatar {

top:170px;
}

.connect-message, .connect-timer {

position:absolute;
top: 300px;
left: 50px;

}

.connect-timer {

top:320px;
font-size: 40px;
left:50px;


}

.abutton, .dbutton {
position: absolute;
left: 150px;
top:340px;
background:#fff;
color:green;
border-radius:5px;

}

.dbutton {
background:#fff;
color:red;
left: 210px;

}


</style>