<!doctype html>
<html>
	<head>
		@include('includes.head')		
	</head>
	<body id="master">
		
		@include('includes.header')

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