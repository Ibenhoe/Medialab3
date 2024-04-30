<!DOCTYPE html>
<html lang="en">

  <head>
    @include('home.css')
    <style>
      
    </style>
    
  </head>

<body>

  @include('home.header')
  <!-- ***** Header Area End ***** -->

  <div class="discover-items">
    <div class="container">
      <div class="row">
        <div class="col-lg-5">
          <div class="section-heading">
             
            <h2>Discover Some Of Our <em>product</em>.</h2>
          </div>
        </div>
        <div class="col-lg-7">
          <form id="search-form" name="gs" method="submit" role="search" action="{{url('search')}}">
            <div class="row">
              <div class="col-lg-4">
                <fieldset>
                    <input type="search" name="search" class="searchText" placeholder="Zoeken..." autocomplete="on" >
                </fieldset>
              </div>
              <div class="col-lg-3">
                <fieldset>
                    <select name="Category" class="form-select" aria-label="Default select example" id="chooseCategory" onchange="this.form.click()">
                        <option selected>All Categories</option>
                        @foreach($data2 as $data2)
                        <option value="{{$data2->id}}">{{$data2->cat_title}}</option>
                        @endforeach
                    </select>
                </fieldset>
              </div>
              <div class="col-lg-3">
                <fieldset>
                    <select name="Price" class="form-select" aria-label="Default select example" id="chooseCategory" onchange="this.form.click()">
                        <option selected>Available</option>
                        <option value="Ending-Soon">Ending Soon</option>
                        <option value="Coming-Soon">Coming Soon</option>
                        <option value="Closed">Closed</option>
                    </select>
                </fieldset>
              </div>
              <div class="col-lg-2">                        
                <fieldset>
                    <button class="main-button">Search</button>
                </fieldset>
              </div>
            </div>
          </form>
        </div>
  
  

  

  @include('home.book')

  @include('home.footer')

  </body>
</html>