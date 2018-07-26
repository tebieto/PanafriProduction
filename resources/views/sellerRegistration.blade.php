<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <title>Buy and Sell in Realtime on Panafri</title>

        @extends('layouts.app2') 
		<!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<link href="{{ asset('css/main.css') }}" rel="stylesheet">
	
    </head>
<body>

<!--Begin Container class DIV-->
      
<div id="app" class="container">

<div id="loader" class="loader">

			
	 <img @click="sellerHomeUrl()" class="panafri-logo"  width="50px" height="auto" src="{{Storage::url('public/icons/panafri-icon.jpg')}}" alt="Panafri icon"><span>Panafri Partner</span>
	 
	 <loader></loader>
	
</div>
	
	  <!--Begin register class div-->

	
	 <div id="login-page"  class="start-selling" >
	 
	 <div class="form-container" @click.stop >
	
	<div class="logo">
			
		<a >  <img @click="sellerHomeUrl()" class="panafri-logo"  width="50px" height="auto" src="{{Storage::url('public/icons/panafri-icon.jpg')}}" alt="Panafri icon"></a>
	 </div>
	
	<div class="hidden" id="uploadedContainer" v-if="productImage.length>0 || uploadDelay.length>0">
				 
		<div v-if="productImage.length>0" class="showUploaded" v-for="file in productImage">
				 <div class="uploaded_file_container">
				 <img  v-if="file.type=='image'" class="uploadedFile" :src="file.URL" width="100" height="100"  alt="" />
				
				 <video v-if="file.type=='video'" class="uploadedFile" width="100" height="100" controls >
				 <source :src="file.URL" :type="file.mime">
				</video>
				 <div id="uploadInfo" ><span class="uploadDelete" @click="removeUploaded"><b>x</b></span></div>
			     </div>
				 <!-- Add Image Spinner -->
				 
				 
	  </div>
	  </div>
	  
	  <form class="start-selling-form" method="POST" action="/register/seller/register">
                        {{ csrf_field() }}
	 
	 <table>
	 
	 <tr>
	 <td>FIRST NAME</td>
	 </tr>
	 
	 <tr>
	
	 <td><input type="text" name="fname"  placeholder="First Name" value="{{ old('fname') }}" required autofocus /></td>
	 </tr>
	 @if ($errors->has('fname'))
     <tr>
       <td><strong>{{ $errors->first('fname') }}</strong></td>
     </tr>
     @endif
	 
	 <tr style="display:none">
	 <td>MIDDLE NAME</td>
	 </tr>
	 
	 <tr style="display:none">
	 
	 <td><input type="text" name="mname"  value="N.A" placeholder="Middle Name" /></td>
	 </tr>
	 @if ($errors->has('mname'))
     <tr>
      <td><strong>{{ $errors->first('mname') }}</strong></td>
     </tr>
     @endif
	 
	  <tr>
	  <td>LAST NAME</td>
	 </tr>
	 
	 <tr>
	
	 <td><input type="text" placeholder="Last Name" name="lname"  value="{{ old('lname') }}" required /></td>
	 </tr>
	 @if ($errors->has('lname'))
     <tr>
        <td><strong>{{ $errors->first('lname') }}</strong></td>
     </tr>
     @endif
	 
	<tr>
	  <td>AVATAR</td>
	 </tr>
	 
	 @if ($errors->has('avatar'))
     <tr>
       <td><strong>{{ $errors->first('avatar') }}</strong></td>
     </tr>
     @endif
	 
	 <tr>
	 
	 <td>
	 <input type="file" id="productimage"  style="display:none;" accept="image/*" v-on:change="imageChange">
				<span @click="showProductImagePicker" class="image-picker" title="Choose file"  ><img  id="" src="/storage/icons/photo_icon.png" width="15px" height="15px"  alt="" /><span class="photo_icon_text"><b> Select</b></span></span>
	 </td>
	 </tr>
	 
	 <div  class="hidden showUploaded" v-for="file in productImage">
	 <input type="text" name="avatar"  placeholder="" :value="file.URL"/>
	 </div>
	 
	 <tr>
	  <td>EMAIL</td>
	 </tr>
	 
	 <tr>
	 
	 <td><input type="email" placeholder="xyz@example.com" name="email"  value="{{ old('email') }}" required /></td>
	 </tr>
	 @if ($errors->has('email'))
     <tr>
       <td><strong>{{ $errors->first('email') }}</strong></td>
     </tr>
     @endif
	 
	 <tr>
	  <td>PHONE NUMBER</td>
	 </tr>
	 
	 <tr>
	 
	 <td><input type="number" placeholder="Phone Number" max="9999999999" name="phone"  value="{{ old('phone') }}" required /></td>
	 </tr>
	 @if ($errors->has('phone'))
     <tr>
       <td><strong>{{ $errors->first('phone') }}</strong></td>
     </tr>
     @endif
	 
	 <tr>
	  <td>PASSWORD</td>
	 </tr>
	 
	
	 <tr>
	
	 <td><input  type="password"  name="password"  value="{{ old('password') }}" required /></td>
	 </tr>
	 @if ($errors->has('password'))
     <tr>
        <td><strong>{{ $errors->first('password') }}</strong></td>
     </tr>
     @endif
	 
	 <tr>
	  <td>CONFIRM PASSWORD </td>
	 </tr>
	 
	  <tr>
	
	 <td><input type="password"  name=" password_confirmation"  value="" required /></td>
	 </tr>
	 @if ($errors->has('password_confirmation'))
     <tr>
       <td><strong>{{ $errors->first('password_confirmation') }}</strong></td>
     </tr>
     @endif
	 <tr>
	 <td>
	 <strong><span><small>By clicking  "Register" you agree to our </small><a class="learn-more">Terms of Service</a> </strong></span>
	 </td>
	 </tr>
	 <tr>
	 
	 <td><button type="submit">SUBMIT</button><a href="/login/seller/login" class="learn-more">Already have an account?</a></td>
	 </tr>
	 
	 
	 </table>
	 
	  <input type="hidden" name="reg" value="register">
	 </form>
	 
	 </div>
	 
	 <!--End of form-container class div-->
	 
	 </div>
	 
	  <!--End of register class div-->
	  
	
</div>
	 
	 <!--End of container class div-->
		
		
		
		@yield('content')
   
		
	<!-- Scripts -->
	 <script src="{{ asset('js/app.js') }}"></script>
  
</body>
</html>