<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <title>Buy and Sell in Realtime on Panafri</title>

        @extends('layouts.app2') 
		<!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
	
    </head>
<body>

<!--Begin Container class DIV-->
      
<div id="app" class="container">


<!--Begin login class div-->

	
	 <div id="login-page" 
	 class="start-selling">
	
	 
	 <!--Begin form-container class div-->	
	 
	 <div class="form-container" @click.stop >
	
	 <div class="logo">
			
		<a href="http://panafri.com">  <img class="panafri-logo"  width="150px" height="auto" src="{{Storage::url('public/icons/panafri-logo.png')}}" alt="Panafri logo"></a>
	 </div>
	 <div class="form-message">
	 When you login, you can buy and sell goods and services with people nearby in realtime right from your dashboard. You can also earn extra money by doing freelance delivery.
	 </div>
	  <form class="welcome-login-form" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
	 
	 <table>
	 
	 <tr><td></td><th><h3>Private Information (<a class="learn-more">Read Data Policy</a>)</h3></th></tr>
	 <tr>
	 
	 <tr>
	 <td>Email</td>
	 <td><input type="email" name="email"  value="{{ old('email') }}" required /></td>
	 </tr>
	 @if ($errors->has('email'))
     <tr>
        <td></td><td><strong>{{ $errors->first('email') }}</strong></td>
     </tr>
     @endif

	 <tr><td></td><th><h3>Sensitive Information (<a class="learn-more">Read Data Policy</a>)</h3></th></tr>
	 <tr>
	 
	
	 <tr>
	 <td>Password</td>
	 <td><input  type="password"  name="password"  value="{{ old('password') }}" required /></td>
	 </tr>
	 @if ($errors->has('password'))
     <tr>
        <td></td><td><strong>{{ $errors->first('password') }}</strong></td>
     </tr>
     @endif
	 
	 
	 <tr>
        <td></td><td><strong>By clicking "Login" you agree that you are over 13 years of age and you accept our <a class="learn-more">Terms of Service</a> </strong></td>
     </tr>
	 
	 <tr>
	 <td></td>
	 <td><button type="submit">Login</button></td>
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