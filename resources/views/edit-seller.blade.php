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

<a href="/login/seller/login"><img class="panafri-logo"  width="150px" height="auto" src="{{Storage::url('public/icons/panafri-logo.png')}}" alt="Panafri logo"></a>
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


<div id="register-form-holder">
<form class="start-selling-form" method="POST" action="/profile/edit/profile">
                        {{ csrf_field() }}
<span id="type-register-name"> <span class="glyphicon glyphicon-user"></span> <input  name="name" type="text" value="{{ auth::user()->name }}" placeholder="EDIT FULL NAME" required></span>

@if ($errors->has('name'))
     <tr>
       <td><strong>{{ $errors->first('name') }}</strong></td>
     </tr>
     @endif

<span id="type-register-email"> <span class="glyphicon glyphicon-envelope"></span> <input  name="email" type="email" value="{{ auth::user()->email }}" placeholder="EDIT EMAIL ADDRESS" required></span>

@if ($errors->has('email'))
     <tr>
       <td><strong>{{ $errors->first('email') }}</strong></td>
     </tr>
     @endif
	 
<span id="type-register-phone"> <span class="glyphicon glyphicon-phone"></span> <input  name="phone" type="number" value="{{ auth::user()->phone }}" placeholder="EDIT PHONE NUMBER" required></span>

@if ($errors->has('phone'))
     <tr>
       <td><strong>{{ $errors->first('phone') }}</strong></td>
     </tr>
 @endif
 
 
<input type="file" id="productimage"  style="display:none;" accept="image/*" v-on:change="imageChange">	 

<div  id="uploadedContainer" v-if="productImage.length==0">
 <div class="showUploaded">
 <img id="edit-avatar" class="uploadedFile" src="{{auth::user()->avatar}}" width="200px" height="200px"  alt="" />
</div>
 </div>
 <span id="type-register-confirm" v-if="productImage.length>0" style="display:none;"> <span class="glyphicon glyphicon-lock"></span> <input type="text" name="avatar" :value="productImage[0].URL" required autofocus></span>
 <div  id="uploadedContainer" v-if="productImage.length>0 || uploadDelay.length>0">
				 
				 <div class="showUploaded" v-for="file in productImage">
				
				 <img id="edit-avatar" v-if="file.type=='image'" class="uploadedFile" :src="file.URL" width="200px" height="200px"  alt="" />
					
			     </div>
				 <!-- Add Image Spinner -->
				 
				 <div id="edit-spinner" class="spinner_wrapper" v-for=" file in uploadDelay">
				 <div class="spinner"></div>
				 </div>
	  </div>
  
<a id="register-login" @click="showProductImagePicker">CHANGE AVATAR</a>
<button id="register-button">EDIT PROFILE</button>

@if ($errors->has('name') || $errors->has('email') || $errors->has('phone') || $errors->has('password'))
<span class="register-form-error"><center>ALL FIELDS ARE REQUIRED, TRY AGAIN</center></span>
 @endif
</form>
</div>

</div>
	  
	 
<!--End of container class div-->

<!-- Scripts -->
	
	 <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/welcome.js') }}"></script>
	
</body>
</html>
