<!doctype html>
<html>
	<head>
		@include('includes.head')		
	</head>
	<body id="master" data-spy="scroll" data-target=".navbar">
		
		@include('includes.header')
		@include('includes.preloader')
		@include('includes.nav_megadeth')

		@yield('content')

		<aside>
			@include('includes.aside')
		</aside>
		<footer id="footer">
			@include('includes.footer')
		</footer>

		@include('includes.scripts')
 
	</body>
</html>