<template>

<div class="transactions">

		<div class="seller-details">
		
		<div style="height: 80px; overflow-y:auto">
		<img class="owner-avatar"  width="50px" height="50px" style="border-radius:50%; margin:10px;" :src="this.image"/>
		
		<div style="margin-top:-50px; margin-left:80px;"><span class="user-name">Rita Ebieto</span> as Seller <span class="unread">100</span><div class="start-chat-button">Chat</div> </div>
		
		</div>
		
		<div class="hr"></div>
		
		<div style="height:80px; overflow-y:auto;">
		<h4 style="margin-left:10px;">Shop #1, NeroTex Salon, yaba, Lagos, Nigeria</h4>
		
		</div>
		
		<div class="hr"></div>
		
		<div style="height:80px; overflow-y:auto;">
		<h4 style="margin-left:10px;">Available at the moment</h4>
		
		</div>
		
		
		
		<div style="height:150px; overflow-y:auto;">
		
		<img class="product-avatar"  width="50px" height="50px" style="border-radius:5px; margin:10px;" :src="this.image"/>
		<span class="pending-product-name">Beans(N100)</span><br>
		<img class="product-avatar"  width="50px" height="50px" style="border-radius:5px; margin:10px;" :src="this.image"/>
		<span class="pending-product-name">Beans(N100)</span><br>
		<img class="product-avatar"  width="50px" height="50px" style="border-radius:5px; margin:10px;" :src="this.image"/>
		<span class="pending-product-name">Beans(N100)</span><br>
		<img class="product-avatar"  width="50px" height="50px" style="border-radius:5px; margin:10px;" :src="this.image"/>
		<span class="pending-product-name">Beans(N100)</span><br>
		<img class="product-avatar"  width="50px" height="50px" style="border-radius:5px; margin:10px;" :src="this.image"/>
		<span class="pending-product-name">Beans(N100)</span><br>
		<img class="product-avatar"  width="50px" height="50px" style="border-radius:5px; margin:10px;" :src="this.image"/>
		<span class="pending-product-name">Beans(N100)</span><br>
		
		
		
		
		
		</div>
		
		<div class="hr"></div>
		
		<div style="height:100px; overflow-y:auto;">
		<h4 style="margin-left:10px;">Total= N1000 Delivery= N1000  <br>Total + Delivery = N 2000</h4>
		<button style="margin-left:10px; border:none; color:#fff; background:green; font-weight:bold;">Accept</button> <button style="margin-left:10px; border:none; color:#000; background:yellow; font-weight:bold;">Finish</button>  <button style="margin-left:10px; border:none; color:#fff; background:red; font-weight:bold;">Decline</button> <button style="margin-left:10px; border:none; color:#fff; background:black; font-weight:bold;">Report</button>
		</div>
	
		</div>
		</div>
		
</template>

<script>

export default {

props: ['image']



}


</script>

<style>

.pending-product-name {
position: relative;
top: -30px;

}

</style>