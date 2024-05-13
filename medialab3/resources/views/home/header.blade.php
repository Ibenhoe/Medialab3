


<!-- ***** Header Area Start ***** -->
<header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->
                    <a href="index.html" class="logo">
                        <img src="assets/images/EhB-logo-transparant(1).png" alt="">
                    </a>
                    <!-- ***** Logo End ***** -->
                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                        <li><a href="{{url('/')}}" class="active">Home</a></li>
                        <li><a href="{{url('mainpage')}}">Explore</a></li>
                        <li><a href="{{url('show_favorites')}}">Item Details</a></li>
                        <li><a href="author.html">Author</a></li>
                        <li><a href="create.html">Create Yours</a></li>

                        @if (Route::has('login'))
                       
                            @auth
                            <li><x-app-layout>
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