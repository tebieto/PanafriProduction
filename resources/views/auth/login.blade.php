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

			
	 <img class="panafri-logo"  width="50px" height="auto" src="{{Storage::url('public/icons/panafri-icon.jpg')}}" alt="Panafri icon"><span>Panafri Connect</span>
	 
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

<div id="login-form-holder">
<form class="welcome-login-form" method="POST" action="/login">
                        {{ csrf_field() }}
<span id="type-login-email"> <span class="glyphicon glyphicon-envelope"></span> <input  name="email" type="email" placeholder="ENTER EMAIL ADDRESS" /></span>

<span id="type-login-password" > <span class="glyphicon glyphicon-lock"></span> <input type="password" name="password" placeholder=" ENTER PASSWORD" autofocus/></span>

<a id="login-register" href="/register">OPEN NEW ACCOUNT</a>
<a id="recover-password" href="/all/recover">RECOVER LOST PASSWORD</a>

@if ($errors->has('email') || $errors->has('password'))
<span class="login-form-error"><center>INVALID EMAIL ADDRESS OR PASSWORD, TRY AGAIN</center></span>
@endif

<button id="login-button">LOGIN</button>

</form>
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
