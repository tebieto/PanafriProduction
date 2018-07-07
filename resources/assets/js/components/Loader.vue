<template>


</template>


<script>

export default {

mounted() {


this.removeLoader()


},


methods: {

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