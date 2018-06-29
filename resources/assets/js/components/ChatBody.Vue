<template>
<div>
<div v-if="this.authDetails.length>0">
<div class="theirChat" v-if="this.authDetails[0].id!=this.id">
<p id="auth" >{{this.body}}</p>
</div>
<div class="myChat" v-if="this.authDetails[0].id==this.id">
<p id="auth" >{{this.body}}</p>
</div>
</div>
</div>


</template>


<script>

export default {

data() {

return {

authDetails:[],


}


},

props: ['body', 'id'],

mounted() {

this.getAuthDetails()

},

methods: {
	
getAuthDetails(){
	
	axios.get('/auth/details').then(response=>{
		
		this.authDetails.push(response.data)
		
	})
	
	
	
},
}

}

</script>

<style>

.hidden {
display:none;

}


</style>



