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
    </head>
<body>

<div id="app" class="container">


<div id="loader" class="loader">

			
	 <img class="panafri-logo"  width="50px" height="auto" src="{{Storage::url('public/icons/panafri-icon.jpg')}}" alt="Panafri icon"><span>Panafri Partner</span>
	 
	 <buyer-loader></buyer-loader>
	 
	
</div>	


<!--Creating Menu Icon from scatch with Css-->

		  
			<div id="showmenu" class="menu-bar" @click="toggleBar()">
			
			<div class="bar1"></div>
			<div class="bar2"></div>
			<div class="bar3"></div>
			
			</div>

<img id="panafri-cover"  src="{{Storage::url('public/icons/panafri-cover.jpeg')}}" alt="Panafri Icon" />
<a href="/app"><img class="panafri-logo"  width="150px" height="auto" src="{{Storage::url('public/icons/panafri-logo.png')}}" alt="Panafri logo"></a>


<div id="toggle-menu" class="menu-holder toggle-menu">
<p id="menu-spacing"></p>
<a href="/home"><p><span class="glyphicon glyphicon-home" ></span> Home</p></a>
<a href="/login"><p><span class="glyphicon glyphicon-arrow-right" ></span>Login</p></a>
<a href="/register"><p><span class="glyphicon glyphicon-user" ></span> Register</p></a>
</div>

<div id="register-form-holder">
<form class="start-selling-form" method="POST" action="/register">
                        {{ csrf_field() }}
<span id="type-register-name"> <span class="glyphicon glyphicon-user"></span> <input  name="name" type="text" value="{{ old('name') }}" placeholder="ENTER FULL NAME" required></span>
<span id="type-register-email"> <span class="glyphicon glyphicon-envelope"></span> <input  name="email" type="email" value="{{ old('email') }}" placeholder="ENTER EMAIL ADDRESS" required></span>
<span id="type-register-phone"> <span class="glyphicon glyphicon-phone"></span> <input  name="phone" type="number" value="{{ old('phone') }}" placeholder="ENTER PHONE NUMBER" required></span>
<span id="type-register-password" > <span class="glyphicon glyphicon-lock"></span> <input type="password" value="{{ old('password') }}" name="password" placeholder=" ENTER PASSWORD" required autofocus></span>
<span id="type-register-confirm" > <span class="glyphicon glyphicon-lock"></span> <input type="password" name="password_confirmation" placeholder=" CONFIRM PASSWORD" required autofocus></span>
<a id="register-login" href="/login">I ALREADY HAVE AN ACCOUNT</a>
<button id="register-button">REGISTER</button>
@if ($errors->has('name') || $errors->has('email') || $errors->has('phone') || $errors->has('password'))
<span class="register-form-error"><center>ALL FIELDS ARE REQUIRED, TRY AGAIN</center></span>
@endif</form>
</div>

<div id="location-search" class="">

<div class="menu-bar change" @click="locationModal()" >
			
			<div class="bar1"></div>
			<div class="bar2"></div>
			<div class="bar3"></div>
			
			</div>
			
<span id="modal-location-span" > <span class="glyphicon glyphicon-map-marker"></span> <input type="text"  id="modal-location-input" placeholder="LOCATION" autofocus></span>

			
</div>
<div id="product-search" class="">

<div class="menu-bar change" @click="productModal()" >
			
			<div class="bar1"></div>
			<div class="bar2"></div>
			<div class="bar3"></div>
			
			</div>


<span id="modal-product-span" > <span class="glyphicon glyphicon-search"></span> <input type="text" id="modal-product-input" placeholder="WHAT ARE YOU LOOKING FOR?" autofocus></span>

</div>


</div>
	  
	 
<!--End of container class div-->

<!-- Scripts -->
	
	 <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/welcome.js') }}"></script>
	
</body>
</html>
