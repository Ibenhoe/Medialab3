


<!-- ***** Header Area Start ***** -->
<header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->
                    <a href="{{url('/')}}" class="logo">
                        <img src="assets/images/eraslogo-white.png" alt="">
                    </a>
                    <!-- ***** Logo End ***** -->
                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                        <li><a href="{{url('/')}}" class="{{ Request::is('/') ? 'active' : '' }}"><img src="assets/images/homeIcon-white.png" alt="" style="max-width: 35px;" ></a></li>
                        <li><a href="{{url('show_favorites')}}" class="{{ Request::is('show_favorites') ? 'active' : '' }}"><img src="assets/images/favorieten-white.png" alt="" style="max-width: 35px;" ></a></li>
                        <li><a href="{{url('show_cart')}}" class="{{ Request::is('show_cart') ? 'active' : '' }}"><img src="assets/images/winkelmandje-white.png" alt="" style="max-width: 35px;" ></a></li>
                        <li><a href="#"><img src="assets/images/kalender-white.png" alt="" style="max-width: 35px;" ></a></li>
                        

                        @if (Route::has('login'))
                       
                            @auth
                            <li><x-app-layout style="margin-top: auto; margin-bottom:auto;">
                                </x-app-layout>
                            </li>
                            @else
                            <li><a href="{{ route('login') }}">Login</a></li>

                            
                            @endauth
                        
                        @endif






                        
                        
                    </ul>
                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>
                    <!-- ***** Menu End ***** -->
                </nav>
            </div>
        </div>
    </div>
</header>