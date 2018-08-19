<template>

<div class="call-partner">

<img class="partner-avatar"  width="100px" height="100" :src="partner[0].avatar" :title="partner[0].name" :alt="partner[0].name" v-if="partner.length>0">
<div v-if="partner.length>0" class="partner-name">{{partner[0].name.toUpperCase()}}</div>
<span id="phone-icon" class="glyphicon glyphicon-phone"></span>
<div v-if="partner.length>0" class="partner-phone">{{partner[0].phone}}</div>

</div>

</template>


<script>


export default {

props: ['pid'],

data() {

return {

partner: [],


}


},

mounted() {

this.getPartnerDetails();

},

methods: {

getPartnerDetails(){
	
	axios.get('/get/user/details/' + this.pid).then(response=>{

		this.partner.push(response.data)
	})
	
},


}



}


</script>


<style>

.partner-avatar, #phone-icon{

position: absolute;
top: 25px;
left:5px;
width:100px;
height:100px;
border:1px solid #eee;
border-radius:50%;


}

.partner-name, .partner-phone {
position:absolute;
font-size:30px;
left:115px;
top: 50px;
color:rgba(0,0,0,.8);
}

.partner-phone {

top:200px;
}

#phone-icon {

top:170px;
padding-left:15px;
padding-top:15px;
color:#000;
font-size:65px;

}


</style>