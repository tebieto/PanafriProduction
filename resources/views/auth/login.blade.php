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

			
	 <img class="panafri-logo"  width="50px" height="auto" src="{{Storage::url('public/icons/panafri-icon.jpg')}}" alt="Panafri icon"><span>Panafri Connect</span>
	 
	 <buyer-loader></buyer-loader>
	 
	
</div>

<!--Begin login class div-->

	
<div id="login-page"  class="start-selling" style="position:fixed;">
	
	 
	 <!--Begin form-container class div-->	
	 
	 <div class="form-container " @click.stop >
	
	 <div class="logo">
			
		<a >  <img @click="homeUrl()" class="panafri-logo"  width="50px" height="auto" src="{{Storage::url('public/icons/panafri-icon.jpg')}}" alt="Panafri icon"></a>
	 </div>

	  <form class="welcome-login-form" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
	 
	 <table>
	
	 <tr>
	  <td>EMAIL</td>
	 </tr>
	 
	 <tr>
	
	 <td><input type="email" name="email"  value="{{ old('email') }}" placeholder="john.doe@example.com" required /></td>
	 </tr>
	 @if ($errors->has('email'))
     <tr>
       <td><strong>{{ $errors->first('email') }}</strong></td>
     </tr>
     @endif
	 
	 @if (session('error'))
     <tr>
       <td><strong>{{ session('error') }}</strong></td>
     </tr>
     @endif
	 
	  <tr>
	  <td>PASSWORD</td>
	 </tr>
	 
	 <tr>
	 
	 <td><input  type="password"  name="password"  value="" required /></td>
	 </tr>
	 @if ($errors->has('password'))
     <tr>
       <td><strong>{{ $errors->first('password') }}</strong></td>
     </tr>
     @endif
	 
	<tr>
    <td>	
	<strong><span><small>By clicking  "Login" you agree with Panafri </small><a class="learn-more">Terms of Service</a> </strong></span>
	 </td>
	 </tr>
	 
	 <tr>
	
	 <td><button type="submit">LOGIN</button><a href="/register" class="learn-more">Register new account</a></td>
	 </tr>
	 
	 
	 </table>
	 
	  <input type="hidden" name="login" value="login">
	 </form>
	 
	 </div>
	 
	 <!--End of form-container class div-->
	 
	 </div>
	 
	  <!--End of login class div-->
	  

</div>
	 
	 <!--End of container class div-->
		
		
		
		@yield('content')
   
		
	<!-- Scripts -->
	 <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/welcome.js') }}"></script>
</body>
</html>