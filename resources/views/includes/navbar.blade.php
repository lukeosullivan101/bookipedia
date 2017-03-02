<nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a id="logo-link" class="navbar-brand" href="{{ route('welcome') }}" style="padding: 0; padding-top:10px">
                        <img src="/uploads/logos/navicon.png">
                    </a>
                </div>

                <div class="collapse navbar-collapse " id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav ">
                            <li><a href="{{ route('write') }}">BECOME A WRITER</a></li>
                            <li><a href="{{ route('books') }}">BOOKS</a></li>
                            <li><a href="{{ route('blog') }}">BLOG</a></li>
                            <li><a href="{{ url('/forums') }}">FORUMS</a></li>
                    </ul>


                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li id="noshow"><a href="https://www.instagram.com/bookipedia.co/" class="instagram"><i class="fa fa-instagram fa-2x"></i></a></li>
                            <li id="noshow"><a href="https://www.facebook.com/Bookipedia-642743749244649/" class="facebook"><i class="fa fa-facebook fa-2x"></i></a></li>
                            <li id="noshow"><a href="https://www.youtube.com/channel/UCzMvgOLdr2GKxebdwlFJFCg" class="youtube"><i class="fa fa-youtube fa-2x last"></i></a></li>
                            
                            <li id="search" style="position:relative; width:150px; z-index:999; margin-top: 10px;">
                                <form action="/search" class="search-form" method="get">
                                <input type="text" name="search" id="search" placeholder="Search"
                                style="padding: 5px; top:-5px; background: #F6F9FB; border: 1px solid #000; border-radius: 15px; z-index: 999999; width: 150px; padding-left:30px; color:#bbb; outline:none;">
                                <i class="fa fa-search" style="position: absolute; top: 8px; left: 10px; color: #555;"></i>
                                </form>
                            </li>
                            <li><a href="{{ url('/login') }}">LOGIN</a></li>
                            <li><a href="{{ url('/register') }}">SIGN UP</a></li>
                        @else
                            <li><a href="https://www.instagram.com/bookipedia.co/" class="instagram"><i class="fa fa-instagram fa-2x"></i></a></li>
                            <li><a href="https://www.facebook.com/Bookipedia-642743749244649/" class="facebook"><i class="fa fa-facebook fa-2x"></i></a></li>
                            <li><a href="https://www.youtube.com/channel/UCzMvgOLdr2GKxebdwlFJFCg" class="youtube"><i class="fa fa-youtube fa-2x last"></i></a></li>
                            <li id="search" style="position:relative; margin-right:50px ; width:150px; z-index:999; margin-top: 10px;">
                                <form action="/search" class="search-form" method="get">
                                <input type="text" name="search" id="search" placeholder="Search"
                                style="padding: 5px; top:-5px; background: #F6F9FB; border: 1px solid #555; border-radius: 15px; z-index: 999999; width: 150px; padding-left:30px; color:#555; outline:none;">
                                <i class="fa fa-search" style="position: absolute; top: 8px; left: 10px; color: #555;"></i>
                                </form>
                            </li>

                            <li class="dropdown">
                               <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="position:relative;">
                                    <img class= "nav-profile" src="/uploads/avatars/{{ Auth::user()->avatar }}">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                               </a>

                                <ul class="dropdown-menu" role="menu">
                                    @if (Auth::user()->is_writer() || Auth::user()->is_admin())
                                            <li>
                                              <a href="{{ route('new-book') }}">Add New Book Summary</a>
                                            </li>
                                            <li>
                                              <a href="{{ url('/user-book/'.Auth::id().'/books') }}">My Books</a>
                                            </li>
                                                @if(Auth::user()->is_admin())
                                                    <li>
                                                      <a href="{{ route('new-post') }}">Add New Blog Post</a>
                                                    </li>
                                                    <li>
                                                      <a href="{{ url('/user/'.Auth::id().'/posts') }}">My Posts</a>
                                                    </li>
                                                    <li>
                                                      <a href="{{ url('/submissions') }}">View Submissions</a>
                                                    </li>
                                                @endif
                                    @endif
                                            <li>
                                              <a href="{{ route('tasks') }}">
                                                <i class="fa fa-btn fa-bookmark"></i>
                                              My Reading List</a>
                                            </li>
                                            <li>
                                              <a href="{{ url('/user/'.Auth::id()) }}">
                                                <i class="fa fa-btn fa-user"></i>
                                              My Profile</a>
                                            </li>
                                    <li>
                                        <a href="{{ url('/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <i class="fa fa-btn fa-sign-out"></i>
                                            Logout
                                        </a>
                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>