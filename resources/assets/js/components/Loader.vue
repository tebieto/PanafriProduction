<template>


</template>


<script>

export default {

mounted() {

this.reload()

this.removeLoader()


},


methods: {

reload() {
setInterval(refresh, 1800000)
function refresh() {	
window.location = "/login/seller/login";
}
},

removeLoader() {

setTimeout(remove, 4000)

function remove() {
var loader = document.getElementById('loader')
loader.classList.add('hidden')
}

}



}



}

</script>