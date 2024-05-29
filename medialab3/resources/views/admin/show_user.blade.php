<!DOCTYPE html>
<html>
  <head> 
    @include('admin.css')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <style type="text/css">
      
        th{
            padding: 20px;
            font-weight: bold;
            font-size: 20px;
            border-bottom: 3px solid grey;
        }
        td{
            padding: 20px;
            border-bottom: 1px solid grey;
        }
        .page-content {
          background-color: #2d3035;
        }
    </style>
  </head>
  <body>
    @include('admin.header')
    <div class="d-flex align-items-stretch">
    @include('admin.sidebar')
    <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">
          
              <!-- Alert message -->
              <div>
                @if(session()->has('message'))
                  <div class="alert alert-success">
                    {{ session()->get('message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true" >x</button>
                  </div>
                @endif
              </div>

              <!-- User list -->
              </div>
                <h1>Gebruiker lijst</h1>
                <table class="div_left">
                    <tr>
                        <th>Naam</th>
                        <th>Email</th>
                    </tr>

                    @foreach($data as $datas)
                    <tr>
                        <td>{{$datas->name}}</td>
                        <td>{{$datas->email}}</td>
                        @if ($datas->Blacklist == 1)
                          <td><button class="btn btn-secondary " disabled>geblacklist</button></td>
                        @else
                        <td><a onclick="confirmation(event)" href="{{url('blacklist', $datas->id)}}"class="btn btn-info">Blacklist</a></td>
                      </tr>
                      @endif
                    @endforeach

                </table>
            </div>
          </div>
        </div>
      </div>
    </div>
      
    @include('admin.footer')

    <!-- Sweetalert for confirmation(event) -->
    <script type="text/javascript">
            function confirmation(ev){
              ev.preventDefault();
              var urlToRedirect = ev.currentTarget.getAttribute('href');
              console.log(urlToRedirect);
          swal({
                title: "Ben je zeker?",
                text: "Eens blacklist zal de gebruiker niet meer het recht hebben om uit te lenen.",
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