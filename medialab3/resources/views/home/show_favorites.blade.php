<!DOCTYPE html>
<html lang="en">

  <head>
    @include('home.css')
    
  </head>

<body>

  @include('home.header')
  <!-- ***** Header Area End ***** -->

  <div class="discover-items" style="padding-top: 200px;">
    <div class="container">
      <div class="row">
      
        
            @foreach($data as $datas)

            <div class="itemBalkje">
                <p>{{$datas->product->title}}</p>
              <div class="knoppenRechts">
                <a href="#" class="reserveer">Reserveer</a>
                <a onclick="confirmation(event)" href="{{url('favo_delete',$datas->id)}}" class="vuilbak"><img src="assets/images/vuilbakje.png"></a>
              </div>
            </div>
            @endforeach
            
          
        </div>
    </div>
  </div>

  @include('home.footer')

  </body>
</html>