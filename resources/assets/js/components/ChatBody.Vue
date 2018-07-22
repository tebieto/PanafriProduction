<template>
<div>
<span v-if="this.authDetails.length>0">
<span v-if="this.authDetails[0].id=this.id && this.status==1">
<p class="authChat">{{this.body}}</p>
</span>
<span v-else>
<p class="userChat">{{this.body}}</p>
</span>
</span>
</div>


</template>


<script>

export default {

data() {

return {

authDetails:[],


}


},

props: ['body', 'id', 'status'],

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



