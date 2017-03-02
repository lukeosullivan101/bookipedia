    <footer id="myFooter">
        <div class="container">
            <div class="row">
                <div class="top"></div>
                <div class="col-md-8 col-md-offset-3 logo-column footer-items">
                    <ul>
                        <li><a href=" {{ url('/books') }}">SUMMARIES</a></li>
                        <li><a href=" {{ url('/blog') }}">ARTICLES</a></li>
                        <li><a href=" {{ url('/forums') }}">FORUMS</a></li>
                        <li><a href="{{ route('about') }}">ABOUT</a></li>
                        <li><a href="{{ route('terms') }}">TERMS</a></li>
                        <li><a href="{{ route('contact') }}">CONTACT</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6 col-md-offset-5 social-networks">
                <a href="https://www.instagram.com/bookipedia.co/" class="instagram"><i class="fa fa-instagram"></i></a>
                <a href="https://www.facebook.com/Bookipedia-642743749244649/" class="facebook"><i class="fa fa-facebook"></i></a>
                <a href="https://www.youtube.com/channel/UCzMvgOLdr2GKxebdwlFJFCg" class="youtube"><i class="fa fa-youtube"></i></a>
            </div>
        </div>
        <div class="footer-copyright">
            <p>©<?php echo date("Y"); ?> BOOKIPEDIA </p>
        </div>
    </footer>

    <!-- ALL JS IMPORTS -->

    <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <!-- Scripts --> 
    <script src="{{ URL::to('js/main.js') }}"></script>

    @yield('js')