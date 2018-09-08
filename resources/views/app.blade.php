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
@if (auth::check())
<buyer-not :id="{{auth::id()}}"></buyer-not>
@endif
<!--Creating Menu Icon from scatch with Css-->

		  
			<div id="showmenu" class="menu-bar" @click="toggleBar()">
			
			<div class="bar1"></div>
			<div class="bar2"></div>
			<div class="bar3"></div>
			
			</div>

<span class="welcome-mantra">Find whatever you want... <br>Wherever you want...</span>			
<img id="panafri-cover"  src="{{Storage::url('public/icons/new-cover.jpg')}}" alt="Panafri Icon" />
<a href="/app"><img class="panafri-logo"  width="150px" height="auto" src="{{Storage::url('public/icons/panafri-logo.png')}}" alt="Panafri logo"></a>



<div id="shadow" class="shadow hidden"></div>
<div class="main-content-holder">


<!-- Products and categories starts here-->

<div id="main-category-holder">

<div class="content-title">TOP CATEGORIES</div>

<!-- Categories right here -->


<div class="no-result" v-if="categories.length==0 ">No category at the moment</div>
<div v-else class="main-category-result" v-for="product in categories">
<img class="category-image"  width="100px" height="100px" :src="product.image" :title="product.name" :alt="product.name">
<div class="category-name" v-if="product.type==1">@{{product.name.slice(0, 25).toUpperCase()}}</div>
<div class="category-name" v-else>@{{product.name.slice(0, 25).toUpperCase()}}</div>
</div>


</div>



<div id="main-product-holder">

<div class="content-title">HOT PRODUCTS </div>

<!-- Products right here -->


<div class="no-result" v-if="products.length==0">No products at the moment</div>
<div v-else class="main-search-result" v-for="product in products">
<img class="product-image"  width="500px" height="auto" :src="product.image" :title="product.name" :alt="product.name">
<div class="product-name">@{{product.name.slice(0, 25).toUpperCase()}}</div>
<div class="new-product-price"><span style="font-size:10px; color:#000; margin-right:5px;">FROM</span><span>&#8358;</span>@{{product.price}}</div>
<div class="new-product-description">@{{product.category.toUpperCase()}} in @{{product.location.toUpperCase()}}</div>
<div class="send-request" @click="callPartner(product.id)"> <span class="glyphicon glyphicon-phone"></span> REQUEST</div>
<!-- <div class="view-seller">EXPLORE PARTNER </div> -->
<span v-if="partnerProduct==product.id" id="remove-contact" @click="removeContact()" class="glyphicon glyphicon-remove"></span>
<partner :pid="product.owner" :pname="product.name" :pimage="product.image" v-if="partnerProduct==product.id"></partner>
</div>


</div>

<div id="main-service-holder">

<div class="content-title">HOT SERVICES</div>

<!-- Products right here -->


<div class="no-result" v-if="services.length==0">No services at the moment</div>
<div v-else class="main-search-result" v-for="product in services">
<img class="product-image"  width="500px" height="auto" :src="product.image" :title="product.name" :alt="product.name">
<div class="product-name">@{{product.name.slice(0, 25).toUpperCase()}}</div>
<div class="new-product-price"><span style="font-size:10px; color:#000; margin-right:5px;">FROM</span><span>&#8358;</span>@{{product.price}}</div>
<div class="new-product-description">@{{product.category.toUpperCase()}} in @{{product.location.toUpperCase()}}</div>
<div class="send-request" @click="callPartner(product.id)"> <span class="glyphicon glyphicon-phone"></span> REQUEST</div>
<!-- <div class="view-seller">EXPLORE PARTNER </div>-->
<span v-if="partnerProduct==product.id" id="remove-contact" @click="removeContact()" class="glyphicon glyphicon-remove"></span>
<partner :pid="product.owner" :pname="product.name" :pimage="product.image" v-if="partnerProduct==product.id"></partner>
</div>


</div>

<!-- Ends here-->


</div>


<div id="toggle-menu" class="menu-holder toggle-menu">
<p id="menu-spacing"></p>



<img id="toggle-avatar" class="uploadedFile" src="{{auth::user()->avatar}}" width="200px" height="200px"  alt="" />


<a ><p style="font-size:20px;"></span>{{auth::user()->name}}</p></a>
<a href="/home"><p><span class="glyphicon glyphicon-home" ></span> Home</p></a>
@if(!auth::check())
<a href="/login"><p><span class="glyphicon glyphicon-arrow-right" ></span>Login</p></a>
<a href="/register"><p><span class="glyphicon glyphicon-user" ></span> Register</p></a>
@endif

@if(auth::check())
<a href="/profile/edit/profile"><p><span class="glyphicon glyphicon-cog" ></span> Edit profile</p></a>
<a href="/password/change/password"><p><span class="glyphicon glyphicon-lock" ></span>Change password</p></a>
<a href="/profile/all/profile"><p><span class="glyphicon glyphicon-user" ></span> Profile</p></a>
<a id="app-logout" href="/all/logout"><p><span class="glyphicon glyphicon-arrow-left" ></span> Logout</p></a>
@endif

</div>

<!--Register form holder is next -->

<div id="register-form-holder" class="hidden">
<form class="start-selling-form" method="POST" action="/register">
                        {{ csrf_field() }}
<span id="type-register-name"> <span class="glyphicon glyphicon-user"></span> <input  name="name" type="text" value="{{ old('name') }}" placeholder="ENTER FULL NAME" required></span>
<span id="type-register-email"> <span class="glyphicon glyphicon-envelope"></span> <input  name="email" type="email" value="{{ old('email') }}" placeholder="ENTER EMAIL ADDRESS" required></span>
<span id="type-register-phone"> <span class="glyphicon glyphicon-phone"></span> <input  name="phone" type="number" value="{{ old('phone') }}" placeholder="ENTER PHONE NUMBER" required></span>
<span id="type-register-password" > <span class="glyphicon glyphicon-lock"></span> <input type="password" value="{{ old('password') }}" name="password" placeholder=" ENTER PASSWORD" required autofocus></span>
<span id="type-register-confirm" > <span class="glyphicon glyphicon-lock"></span> <input type="password" name="password_confirmation" placeholder=" CONFIRM PASSWORD" required autofocus></span>
<a id="register-login" @click="showLogin">I ALREADY HAVE AN ACCOUNT</a>
<button id="register-button" @click="regUser()">REGISTER</button>
@if ($errors->has('name') || $errors->has('email') || $errors->has('phone') || $errors->has('password'))
<span class="register-form-error"><center>ALL FIELDS ARE REQUIRED, TRY AGAIN</center></span>
@endif</form>
</div>

<!--login form holder is next -->

<div id="login-form-holder" class="hidden">
<form class="welcome-login-form" method="POST" action="/login">
                        {{ csrf_field() }}
<span id="type-login-email"> <span class="glyphicon glyphicon-envelope"></span> <input  name="email" type="email" placeholder="ENTER EMAIL ADDRESS" /></span>

<span id="type-login-password" > <span class="glyphicon glyphicon-lock"></span> <input type="password" name="password" placeholder=" ENTER PASSWORD" autofocus/></span>

<a id="login-register" @click="showRegister">OPEN NEW ACCOUNT</a>
<a id="recover-password" href="/all/recover">RECOVER LOST PASSWORD</a>

<button id="login-button">LOGIN</button>

</form>
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
<div class="new-product-price"><span style="font-size:15px; color:#000; margin-right:5px;">from</span><span>&#8358;</span>@{{product.price}}</div>
<div class="new-product-description">@{{product.category.toUpperCase()}} in @{{product.location.toUpperCase()}}</div>
<div class="send-request" @click="callPartner(product.id)"> <span class="glyphicon glyphicon-phone"></span> REQUEST</div>
<!-- <div class="view-seller">EXPLORE PARTNER </div> -->
<span v-if="partnerProduct==product.id" id="remove-contact" @click="removeContact()" class="glyphicon glyphicon-remove"></span>
<partner :pid="product.owner" :pname="product.name" :pimage="product.image" v-if="partnerProduct==product.id"></partner>

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
	<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA9UvOBBIiDC2jHTXnhkRkFstMvgNfRHmI">
    </script>
</body>
</html>
