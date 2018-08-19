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
    </head>
<body>

<div id="app" class="container">


<div id="loader" class="loader">

			
	 <img class="panafri-logo"  width="50px" height="auto" src="{{Storage::url('public/icons/panafri-icon.jpg')}}" alt="Panafri icon"><span>Panafri Connect</span>
	 
	 <buyer-loader></buyer-loader>
	 
	
</div>	


<!--Creating Menu Icon from scatch with Css-->

		  
			<div id="showmenu" class="menu-bar" @click="toggleBar()">
			
			<div class="bar1"></div>
			<div class="bar2"></div>
			<div class="bar3"></div>
			
			</div>

<span class="welcome-mantra">Find whatever you want... <br>Wherever you want...</span>			
<img id="panafri-cover"  src="{{Storage::url('public/icons/new-cover.jpg')}}" alt="Panafri Icon" />
<a href="/app"><img class="panafri-logo"  width="150px" height="auto" src="{{Storage::url('public/icons/panafri-logo.png')}}" alt="Panafri logo"></a>




<div class="main-content-holder">


<!-- Products and categories starts here-->

<div id="main-category-holder">

<div class="content-title">Top Categories</div>

<!-- Products right here -->


<div class="no-result" v-if="categories.length==0 ">No category at the moment</div>
<div v-else class="main-search-result" v-for="product in categories">
<img class="product-image"  width="500px" height="auto" :src="product.image" :title="product.name" :alt="product.name">
<div class="product-name" v-if="product.type==1">PRODUCT - @{{product.name.slice(0, 25).toUpperCase()}}</div>
<div class="product-name" v-else>SERVICE - @{{product.name.slice(0, 25).toUpperCase()}}</div>
</div>


</div>



<div id="main-product-holder">

<div class="content-title">Hot Products </div>

<!-- Products right here -->


<div class="no-result" v-if="products.length==0">No products at the moment</div>
<div v-else class="main-search-result" v-for="product in products">
<img class="product-image"  width="500px" height="auto" :src="product.image" :title="product.name" :alt="product.name">
<div class="product-name">@{{product.name.slice(0, 25).toUpperCase()}}</div>
<div class="new-product-price"><span style="font-size:15px; color:#000; margin-right:5px;">Starting from</span><span>&#8358;</span>@{{product.price}}</div>
<div class="new-product-description">@{{product.category.toUpperCase()}} in @{{product.location.toUpperCase()}}</div>
<div class="send-request" @click="callPartner(product.id)"> <span class="glyphicon glyphicon-phone"></span> CALL PARTNER</div>
<div class="view-seller">EXPLORE PARTNER </div>
<span v-if="partnerProduct==product.id" id="remove-contact" @click="removeContact()" class="glyphicon glyphicon-remove"></span>
<partner :pid="product.owner" v-if="partnerProduct==product.id"></partner>


</div>


</div>

<div id="main-service-holder">

<div class="content-title">Hot Services </div>

<!-- Products right here -->


<div class="no-result" v-if="services.length==0">No services at the moment</div>
<div v-else class="main-search-result" v-for="product in services">
<img class="product-image"  width="500px" height="auto" :src="product.image" :title="product.name" :alt="product.name">
<div class="product-name">@{{product.name.slice(0, 25).toUpperCase()}}</div>
<div class="new-product-price"><span style="font-size:15px; color:#000; margin-right:5px;">Starting from</span><span>&#8358;</span>@{{product.price}}</div>
<div class="new-product-description">@{{product.category.toUpperCase()}} in @{{product.location.toUpperCase()}}</div>
<div class="send-request" @click="callPartner(product.id)"> <span class="glyphicon glyphicon-phone"></span> CALL PARTNER</div>
<div class="view-seller">EXPLORE PARTNER </div>
<span v-if="partnerProduct==product.id" id="remove-contact" @click="removeContact()" class="glyphicon glyphicon-remove"></span>
<partner :pid="product.owner" v-if="partnerProduct==product.id"></partner>


</div>


</div>

<!-- Ends here-->


</div>


<div id="toggle-menu" class="menu-holder toggle-menu">
<p id="menu-spacing"></p>
<a href="/home"><p><span class="glyphicon glyphicon-home" ></span> Home</p></a>
@if(!auth::check())
<a href="/login"><p><span class="glyphicon glyphicon-arrow-right" ></span>Login</p></a>
<a href="/register"><p><span class="glyphicon glyphicon-user" ></span> Register</p></a>
@endif

@if(auth::check())
<a href="/profile/all/profile"><p><span class="glyphicon glyphicon-user" ></span> Profile</p></a>
<a id="app-logout" href="/all/logout"><p><span class="glyphicon glyphicon-arrow-left" ></span> Logout</p></a>
@endif
</div>


<div id="search-holder">
<span><input id="product-input" type="text" placeholder="SEARCH KEYWORD" @keyup="findProducts" @change="prepareSearch" v-model="searchedProduct" /><span id="location-span" > <span class="glyphicon glyphicon-map-marker"></span> <input type="text"  id="location-input" placeholder="LOCATION" @keyup="findLocations" @change="prepareSearch" v-model="searchedLocation" /></span><button @click="startSearch"><span class="glyphicon glyphicon-search"></span></button></span>
</div>

<div class="product-results" v-if="searchedProduct.length>0 && productSuggest">
<div v-if="productResults.length>0">Suggestions</div>
<div v-else>No match for this keyword</div>
<p v-for="product in productResults" @click="pushProduct(product.name)">@{{product.name}}</p>

</div>

<div class="location-results" v-if="searchedLocation.length>0 && locationSuggest">

<div v-if="locationResults.length>0">Suggestions</div>
<div v-else>No match for this keyword</div>
<p v-for="location in locationResults" @click="pushLocation(location.location)">@{{location.location}}</p>

</div>

<div id="location-search" class="">

<div class="menu-bar change" @click="locationModal()" >
			
			<div class="bar1"></div>
			<div class="bar2"></div>
			<div class="bar3"></div>
			
			</div>
			
<span id="modal-location-span" > <span class="glyphicon glyphicon-map-marker"></span> <input type="text"  id="modal-location-input" placeholder="LOCATION" autofocus></span>

			
</div>
<div class="spinner-modal" v-if="showSpinnerModal">
<div id="post_spinner"><div class="post_spinner" ></div></div>
</div>
<div id="product-search" class="" v-on:mouseleave="hideSpinner" @click="hideSpinner">
<img class="panafri-logo"  width="50px" height="auto" src="{{Storage::url('public/icons/panafri-icon.jpg')}}" alt="Panafri icon">
<div class="search-title">Panafri Search Result</div>
<div class="search-result-container">
<span class="result-message"> Search: <span v-if="searchedProduct.length>0">@{{searchedProduct}}</span><span v-else>NULL</span>, Location: <span v-if="searchedLocation.length>0"> @{{searchedLocation}}</span><span v-else>NULL</span></span>
<span class="no-result" v-if="mainSearchResult.length==0">Your search does not match any record, try again.</span>
<div v-else class="main-search-result" v-for="product in mainSearchResult">
<img class="product-image"  width="500px" height="auto" :src="product.image" :title="product.name" :alt="product.name">
<div class="product-name">@{{product.name.slice(0, 25).toUpperCase()}}</div>
<div class="new-product-price"><span style="font-size:15px; color:#000; margin-right:5px;">Starting from</span><span>&#8358;</span>@{{product.price}}</div>
<div class="new-product-description">@{{product.category.toUpperCase()}} in @{{product.location.toUpperCase()}}</div>
<div class="send-request" @click="callPartner(product.id)"> <span class="glyphicon glyphicon-phone"></span> CALL PARTNER</div>
<div class="view-seller">EXPLORE PARTNER </div>
<span v-if="partnerProduct==product.id" id="remove-contact" @click="removeContact()" class="glyphicon glyphicon-remove"></span>
<partner :pid="product.owner" v-if="partnerProduct==product.id"></partner>

</div>
</div>

<div class="menu-bar change" @click="productSearchModal()" >
			
			<div class="bar1"></div>
			<div class="bar2"></div>
			<div class="bar3"></div>
			
			</div>

</div>



</div>
	  
	 
<!--End of container class div-->

<!-- Scripts -->
	
	 <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/welcome.js') }}"></script>
	
</body>
</html>
