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



<seller-not :id="{{auth::id()}}"></seller-not>


<!--Creating Menu Icon from scatch with Css-->

		  
			<div id="showmenu" class="menu-bar" @click="toggleBar()">
			
			<div class="bar1"></div>
			<div class="bar2"></div>
			<div class="bar3"></div>
			
			</div>

<a href="/"><img class="panafri-logo"  width="150px" height="auto" src="{{Storage::url('public/icons/panafri-logo.png')}}" alt="Panafri logo"></a>
<div class="content-header"><span id="add-product-plus" @click="toggleBar()" >+</span></div>



<div id="toggle-menu" class="menu-holder toggle-menu">
<p id="menu-spacing"></p>

<img id="toggle-avatar" class="uploadedFile" src="{{auth::user()->avatar}}" width="200px" height="200px"  alt="" />


<a ><p style="font-size:20px;"></span>{{auth::user()->name}}</p></a>

<a href="/login/seller/login"><p><span class="glyphicon glyphicon-home" ></span> Home</p></a>
<a href="/products/seller/products"><p><span class="glyphicon glyphicon-book" ></span> Your products</p></a>
<a href="/services/seller/services"><p><span class="glyphicon glyphicon-briefcase" ></span> Your services</p></a>
<a href="/profile/seller/profile"><p><span class="glyphicon glyphicon-user" ></span> View profile</p></a>
<!--
<a href="/edit/seller/profile"><p><span class="glyphicon glyphicon-cog" ></span> Edit profile</p></a>
<a href="/edit/seller/avatar"><p><span class="glyphicon glyphicon-camera" ></span> Change avatar </p></a>

-->
<a id="app-logout" href="/seller/logout"><p><span class="glyphicon glyphicon-arrow-left" ></span> Logout</p></a>
</div>



<!-- Edit form right here-->


<div id="login-form-holder">
 <form class="welcome-login-form" method="POST" action="/password/change/password">
                        {{ csrf_field() }}
<span id="type-login-email"> <span class="glyphicon glyphicon-lock"></span> <input  name="password" type="password" placeholder="NEW PASSWORD" required /></span>

<span id="type-login-password" > <span class="glyphicon glyphicon-lock"></span> <input type="password" name="password_confirmation" placeholder=" CONFIRM PASSWORD" required autofocus/></span>

@if ($errors->has('password'))
<span class="login-form-error"><center>{{$errors->first('password')}}</center></span>
@endif
<button id="login-button">CHANGE PASSWORD</button>


</form>
</div>

</div>
	  
	 
<!--End of container class div-->

<!-- Scripts -->
	
	 <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/welcome.js') }}"></script>
	
</body>
</html>
