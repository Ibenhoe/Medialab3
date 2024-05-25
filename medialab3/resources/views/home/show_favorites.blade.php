<!DOCTYPE html>
<html lang="en">

<head>
  @include('home.css')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</head>

<body>

  @include('home.header')
  
  <!-- List of favortis-->
  <div class="discover-items" style="padding-top: 200px;">
    <div class="container">
      <div class="row">
        <h1 class="favoh1">Favorieten</h1>

        @foreach($data as $datas)

        <div class="itemBalkje">
          <p>{{$datas->product->Merk}} {{$datas->product->title}}</p>
          <div class="knoppenRechts">
            <a href="{{url('details_product',$datas->product->id)}}" class="reserveer">Reserveer</a>
            <a onclick="confirmation(event)" href="{{url('favo_delete',$datas->id)}}" class="vuilbak"><img src="assets/images/vuilbakje.png"></a>
          </div>
        </div>

        @endforeach

      </div>
    </div>
  </div>

  @include('home.footer')

  <!-- Sweetalert for confirmation(event) -->
  <script type="text/javascript">
            function confirmation(ev){
              ev.preventDefault();
              var urlToRedirect = ev.currentTarget.getAttribute('href');
              console.log(urlToRedirect);
          swal({
                title: "Are you sure?",
                text: "This product will be deleted from your favorits",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willCancel) => {
              if (willCancel) {
                window.location.href = urlToRedirect
              }});
            }
    </script>

</body>

</html>