<!doctype html>
<html>
	<head>
		@include('includes.head')		
	</head>
	<body data-spy="scroll" data-target=".navbar" id="master">

		@include('includes.preloader')
		@include('includes.header')
		@include('includes.nav_megadeth')

		@yield('content')

		<aside>
			@include('includes.aside')
		</aside>
		<footer id="footer">
			@include('includes.footer')
		</footer>

		@include('includes.scripts_stripe')
 
	</body>
</html>