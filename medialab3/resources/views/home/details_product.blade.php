<!DOCTYPE html>
<html lang="en">

  <head>
    <base href="/public">
    @include('home.css')
    <style>
      .col-lg-5 align-self-center{
        display: flex;
        flex-direction: column;
      }
      .col-lg-7{
        display: flex;
        flex-direction: column;
      }
      .item-details-page h4{
        margin-top: 25px;
      }
      .discover-items{
        padding: 120px 0 20px 0;
      }
    </style>
    
  </head>

<body>

  @include('home.headerdetailspage')
  <!-- ***** Header Area End ***** -->
  <div class="discover-items">
    <div class="container">
    <div class="volledigeDiv">
        <div class="linkerDiv">
            <div class="fotoDiv"><img src="/producten_images/{{$data->product_img}}"></div>
            <hr>
            <div class="balkjeOnderFoto">
                <p>{{$data->Merk}} {{$data->title}}</p>
                <div class="favorietenDiv">
                    <div><a href="{{url('add_favorites', $data->id)}}"><p>Favorieten</p></a></div>
                    <div><a href="{{url('add_favorites', $data->id)}}"><img src="assets/images/favorieten-white.png" alt="" style="max-width: 35px;" ></a></div>
                </div>
            </div>
            <hr>
            <div class="productBeschrijving">
                <h1>Beschrijving</h1>
                <p>{{$data->description}}</p>
            </div>
            
        </div>

 
        <div class="rechterDiv">
            <div class="bovenDiv">
                <div class="kalenderDiv">
                <label for="calender">Kies een datum:</label>
                <input type="date" id="calender" name="calender_detail_page">
                </div>
    
                <div class="knop1"><a href="">Reserveren en toevoegen aan mandje</a></div>
            </div>
        </div>
    </div>

    
      


      </div>
    </div>
  </div>
  
  
 

  @include('home.footer')

  </body>
</html>