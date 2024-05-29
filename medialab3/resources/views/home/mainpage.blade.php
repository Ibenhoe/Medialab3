<!DOCTYPE html>
<html lang="en">

<head>
  @include('home.css')
  <style>


  </style>

</head>

<body>

  @include('home.header')
  

  <div class="discover-items">
    <div class="container">
      <div class="row">
        <div class="col-lg-5">

          <!-- Header -->
          <div class="section-heading">
            <h2><em style="color: #e30613;">Bekijk</em> alles wat beschikbaar is.</h2>
          </div>
        </div>

        <!-- Searchbar mainpage -->
        <div class="col-lg-7">
          <form id="search-form" name="gs" method="submit" role="search" action="{{url('search')}}">
            <div class="row">
              <div class="col-lg-4">
                <fieldset>
                  <input type="search" name="search" class="searchText" placeholder="Zoeken..." autocomplete="on">
                </fieldset>
              </div>

              <!-- Category selector -->
              <div class="col-lg-3">
                <fieldset>
                  <select name="Category" class="form-select" aria-label="Default select example" id="chooseCategory" onchange="this.form.click()">
                    <option selected>Alle categorieën</option>
                    @foreach($data2 as $data2)
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
                  <button style="background-color: #e30613;border: 1px solid white;" class="main-button">Zoeken</button>
                </fieldset>
              </div>
            </div>
          </form>
        </div>
        <div>
          @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}    
            </div>
          @endif
        </div>


  @include('home.product')

  @include('home.footer')
  <script>
        $(document).ready(function(){
            setTimeout(function(){
                $(".alert").alert('close');
            }, 3000); // 5000 milliseconden = 5 seconden
        });
    </script>
</body>

</html>