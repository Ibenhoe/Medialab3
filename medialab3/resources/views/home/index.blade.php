<!DOCTYPE html>
<html lang="en">

  <head>
    @include('home.css')

    <style>
      .logo{
        width: 3.5rem;
      }
      .searchText {
        width: 400px !important;
      }
    </style>
    
  </head>

<body>

  @include('home.header')
  

  <div class="discover-items">
    <div class="container">
      <div class="row">
        <div class="col-lg-5">
        <div class="section-heading">
            <h2><em>Bekijk</em> alles wat beschikbaar is.</h2>
          </div>
        </div>

        
        <!-- Searchbar mainpage -->
        <div class="col-lg-7">
          <form id="search-form" name="gs" method="submit" role="search" action="{{url('search')}}">
            <div class="row">
              <div class="col-lg-4">

                <fieldset>
                    <input type="search" name="search" class="searchText" placeholder="Zoeken..." autocomplete="on" >
                </fieldset>

              </div>

              <!-- Category selector -->
              <div class="col-lg-3">
                <fieldset>
                    <select name="Category" class="form-select" aria-label="Default select example" id="chooseCategory" onchange="this.form.click()">
                        <option selected>All Categories</option>
                        @foreach($data as $data2)
                        <option value="{{$data2->id}}">{{$data2->cat_title}}</option>
                        @endforeach
                    </select>
                </fieldset>
              </div>

              <!-- Available selector -->
              <div class="col-lg-3">
                <fieldset>
                  <select name="Beschikbaarheid" class="form-select" aria-label="Default select example" id="chooseCategory" onchange="this.form.click()">
                    <option value="Beschikbaar" selected>Beschikbaar</option>
                    <option value="Niet_beschikbaar">Niet beschikbaar</option>

                  </select>
                </fieldset>
              </div>

              <!-- Search button -->
              <div class="col-lg-2">                        
                <fieldset>
                    <button class="main-button">Search</button>
                </fieldset>

              </div>
            </div>
          </form>
        </div>
  
  

  

  @include('home.product')

  @include('home.footer')

  </body>
</html>