
      <!-- Sidebar Navigation-->
      <nav id="sidebar">
        <!-- Sidebar Header-->
        <div class="sidebar-header d-flex align-items-center">
          <div class="avatar"><img src="admin/img/EmptyAvatar.jpg" alt="..." class="img-fluid rounded-circle"></div>
          <div class="title">
            <h1 class="h5">Persoon x</h1>
            <p>Administrator</p>
          </div>
        </div>
        <!-- Sidebar Navidation Menus-->
        <ul class="list-unstyled">
                <li ><a href="{{url('home')}}"> <i class="icon-home"></i>Startpagina</a></li>
                <li class="active"><a href="{{url('categorie_page')}}"> <i class="icon-grid"></i>Categorie</a></li>
                
                <li><a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-windows"></i>Producten</a>
                  <ul id="exampledropdownDropdown" class="collapse list-unstyled ">
                    <li><a href="{{url('add_product')}}">Product toevoegen</a></li>
                    <li><a href="{{url('show_product')}}">Producten bekijken</a></li>
                  </ul>
                </li>
                <li><a href="{{url('show_user')}}"> <i class="icon-user"></i>Gebruikers</a></li>
                <li><a href="{{url('show_blacklist')}}"> <i class="icon-user"></i>Blacklist</a></li>
      </nav>