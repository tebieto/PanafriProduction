<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
       
        <title>Buy and Sell in Realtime on Panafri</title>
		 @extends('layouts.app2') 
		<!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<!-- Styles -->
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/others.css') }}" rel="stylesheet">
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	</head>
<body>

<div id="app" class="container">


<div id="loader" class="loader">

			
	 <img class="panafri-logo"  width="50px" height="auto" src="{{Storage::url('public/icons/panafri-icon.jpg')}}" alt="Panafri icon"><span>Panafri Admin</span>
	 
	 <buyer-loader></buyer-loader>
	 
	
</div>	


<!--Creating Menu Icon from scatch with Css-->

		  
			<div id="showmenu" class="menu-bar" @click="toggleBar()">
			
			<div class="bar1"></div>
			<div class="bar2"></div>
			<div class="bar3"></div>
			
			</div>

<a href="/app"><img class="panafri-logo"  width="150px" height="auto" src="{{Storage::url('public/icons/panafri-logo.png')}}" alt="Panafri logo"></a>
<div class="content-header"><span id="add-product-plus" @click="toggleBar()" >+</span></div>



<div class="content-holder">

<div class="content-title">Panafri Services </div>

<!-- Products right here -->


<div class="no-result" v-if="services.length==0">No service at the moment</div>
<div v-else class="main-search-result" v-for="product in services">
<img class="product-image"  width="500px" height="auto" :src="product.image" :title="product.name" :alt="product.name">
<div class="product-name">@{{product.name.slice(0, 25).toUpperCase()}}</div>
<div class="new-product-price"><span style="font-size:15px; color:#000; margin-right:5px;">from</span><span>&#8358;</span>@{{product.price}}</div>
<div class="new-product-description">@{{product.category.toUpperCase()}} in @{{product.location.toUpperCase()}}</div>
<div class="send-request" @click="callPartner(product.id)"> <span class="glyphicon glyphicon-remove"></span> DELETE</div>

<span v-if="partnerProduct==product.id" id="remove-contact" @click="removeContact()" class="glyphicon glyphicon-remove"></span>
<button v-if="partnerProduct==product.id"  @click="adminDeleteService(product.id)" id="yes-button">Yes</button>  <button v-if="partnerProduct==product.id"  @click="removeContact()" id="no-button">No</button>
<div class="call-partner" v-if="partnerProduct==product.id">
<div class="sure">Are you sure you want to delete this service?</div>
</div>

</div>


</div>


<div id="toggle-menu" class="menu-holder toggle-menu">
<p id="menu-spacing"></p>
<a href="/admin/panafri/admin"><p><span class="glyphicon glyphicon-home" ></span> Home</p></a>
<a href="/products/admin/products"><p><span class="glyphicon glyphicon-book" ></span> Checkmate products</p></a>
<a href="/services/admin/services"><p><span class="glyphicon glyphicon-briefcase" ></span> Checkmate services</p></a>
<a href="/categories/admin/categories"><p><span class="glyphicon glyphicon-briefcase" ></span> Checkmate categories</p></a>
<a id="app-logout" href="/seller/logout"><p><span class="glyphicon glyphicon-arrow-left" ></span> Logout</p></a>
</div>

<div id="location-search" class="">

<div class="menu-bar change" @click="locationModal()" >
			
			<div class="bar1"></div>
			<div class="bar2"></div>
			<div class="bar3"></div>
			
			</div>
			
<span id="modal-location-span" > <span class="glyphicon glyphicon-map-marker"></span> <input type="text"  id="modal-location-input" placeholder="LOCATION OF PRODUCT" autofocus></span>

			
</div>
<div id="product-search" class="">

<div class="menu-bar change" @click="productModal()" >
			
			<div class="bar1"></div>
			<div class="bar2"></div>
			<div class="bar3"></div>
			
			</div>


<span id="modal-product-span" > <span class="glyphicon glyphicon-search"></span> <input type="text" id="modal-product-input" placeholder="Find excellent products or sevices" autofocus></span>

</div>

<div id="product-page" class="product-page">

<div class="menu-bar change" @click="showProductPage" >
			
			<div class="bar1"></div>
			<div class="bar2"></div>
			<div class="bar3"></div>
			
			</div>
			
			 <!-- Begin Adding image upload -->
	 
	 <div  id="uploadedContainer" v-if="productImage.length>0 || uploadDelay.length>0">
				 
				 <div class="showUploaded" v-for="file in productImage">
				
				 <img  v-if="file.type=='image'" class="uploadedFile" :src="file.URL" width="100" height="100"  alt="" />
				
				 <div id="deletePhoto" @click="removeUploaded"><span class="uploadDelete" ><b>x</b></span></div>
			     </div>
				 <!-- Add Image Spinner -->
				 
				 <div class="spinner_wrapper" v-for=" file in uploadDelay">
				 <div class="spinner"></div>
				 </div>
	  </div>
			
	  <div v-else class="upload-product-image" @click="showProductImagePicker">
			<span id="camera" class="glyphicon glyphicon-camera"></span>
			<span id="upload-message">Upload category photo</span>
			<input type="file" id="productimage"  style="display:none;" accept="image/*" v-on:change="imageChange">
	  </div>
			
			<div class="add-product-form">
			
			<span id="select-product-category">
			<span class="glyphicon glyphicon-check"></span>
			
			<!--
			
			Use this select for all categories
			
			-->
			<select name="Choose category" v-model="categoryType">
			<option value="0" selected="disabled">SELECT TYPE</option>
			<option value="2">Service category</option>
			<option value="1">Product category</option>
			</select>
			
			
			</span>
			
			<span id="type-product-name">
			<span class="glyphicon glyphicon-pencil"></span>
			<input type="text" name="name" placeholder="NAME OF CATEGORY" v-model="categoryName">
			</span>

			<button id="submit-product-button" v-if="!show_post_spinner" id="addProduct" class="addProductButton post_button" type="submit" @click="submitCategory()" :disabled="cdisabled" >SUBMIT CATEGORY</button>
			<div class="spinner-modal" v-if="showSaving">
			<div  class="submit-alert ">
			<div class="post_spinner" v-if="!showSaved"></div>
			<div class="submitOk" v-if="showSaved" @click="closeSaver">OK</div>
			<div class="saved" v-if="showSaved">Submitted successfully.</div>
			</div>
			</div>
			
			</div>

</div>





</div>
	  
	 
<!--End of container class div-->

<!-- Scripts -->
	
	 <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/welcome.js') }}"></script>
	
</body>
</html>
