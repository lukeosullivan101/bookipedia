<!--Application head section -->
@include('includes.head')
<body>
    
    <div id="app">
    
    <!--Application header/navbar -->
    @include('includes.navbar')
     @include('includes.message-block')
	@yield('content')
   
    </div> <!-- App -->

	<!-- Footer -->
	@include('includes.footer')
	
</body>
</html>
