<template>

<div class="call-partner">
<div class="sure">Are you sure you want to delete this product?</div>
</div>


</template>


<script>


export default {

props: ['pid'],

data() {

return {

partner: [],
deleted: true,


}


},

mounted() {


},

methods: {




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

font-size:65px;

}

.call-partner {
color:#000;

}

.sure {
margin-left:10px;
margin-top:50px;
font-size:20px;

}

.deleted-product {
position:absolute;
top:0px;
left:0px;
width:100%;
height:100%;
z-index:7;
background:#fff;
padding-left: 20px;
padding-top:20px;

}



</style>