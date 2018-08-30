<template>

<div class="call-partner">

<img class="partner-avatar"  width="100px" height="100" :src="partner[0].avatar" :title="partner[0].name" :alt="partner[0].name" v-if="partner.length>0">
<div v-if="partner.length>0" class="partner-name">{{partner[0].name.toUpperCase()}}</div>
<!--
<span id="phone-icon" class="glyphicon glyphicon-phone"></span>
<div v-if="partner.length>0" class="partner-phone">{{partner[0].phone}}</div>
-->
<img class="product-avatar"  width="100px" height="100" :src="this.pimage" :title="this.pname" :alt="this.pname">
<div v-if="partner.length>0" class="sub-product-name" >{{this.pname.toUpperCase()}}</div>

<div v-if="partner.length>0 && timer>0  && accepted==false && cancelled==false" class="connect-message">CONNECTING YOU TO {{partner[0].name.toUpperCase()}}...</div>
<div v-if="partner.length>0 && accepted==true && cancelled==false" class="connect-message">CONNECTED!!! {{partner[0].name.toUpperCase()}} WILL CALL SHORTLY.</div>

<div v-if="timer>0 && cancelled==false && accepted==false" class="connect-timer"><span style="font-size:15px;">in </span>{{this.timer}}<span style="font-size:15px;">s</span></div>
<div v-if="partner.length>0 && timer==0 && accepted==false" class="connect-timer"><span style="font-size:20px;">{{partner[0].name.toUpperCase()}} IS NOT AVAILABLE</span></div>
</div>

</template>


<script>


export default {

props: ['pid', 'pname', 'pimage',],

data() {

return {

partner: [],
timer:120,
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



getPartnerDetails(){
	
	axios.get('/get/user/details/' + this.pid).then(response=>{

		this.partner.push(response.data)
	})
	
},

startTimer() {

var time= setInterval(this.subTime, 1200)

},

subTime() {
this.accepted = this.$store.state.accept
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
				
	checkAccept(){
	var accepted = this.$store.state.accept
	if(accepted==true) {
	this.accepted= true
	}
	return accepted
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


</style>