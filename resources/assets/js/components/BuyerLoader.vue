<template>

<div>
<audio id="buyer_audio"  src="/storage/audios/buyer-alarm.mp3"></audio>
</div>

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
window.location = "/app";
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