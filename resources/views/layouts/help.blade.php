<!doctype html>
<html>
	<head>
		@include('includes.head')		
	</head>
	<body data-spy="scroll" data-target=".navbar" id="master">

		@include('includes.preloader')
		@include('includes.nav_help')

		@yield('content')

		<aside>
			@include('includes.aside')
		</aside>
		<footer id="footer">
			@include('includes.footer')
		</footer>

		@include('includes.scripts_megadeth')
 
	</body>
</html>