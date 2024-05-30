
<!DOCTYPE html>
<html>
  <head> 
    @include('admin.css')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <style>
        .div_left{
            margin-left: 20px;
        }
        h1{
            margin-left: 20px;
            font-size: x-large !important;
            margin-right: 120px !important;
        }
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
        .balkje {
          display: flex;
        }
        .searchText{
          background-color: #282b2f !important;
          border-radius: 2em !important;
          height: 2.1em !important;
          width: 500px !important;
        }
        
    </style>
  </head>
  <body>
    @include('admin.header')
    <div class="d-flex align-items-stretch">
    @include('admin.sidebar')
      <!-- Sidebar Navigation end-->
      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">

            <div>
              <div>
                @if(session()->has('message'))
                  <div class="alert alert-success">
                    {{ session()->get('message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true" >x</button>
                  </div>
                @endif
              </div>
              </div>
                <div class="balkje">
                  <h1>Producten lijst</h1>
                  <input type="search" name="search" class="searchText" placeholder="Zoeken..." autocomplete="on">
                </div>
                <table class="div_left">
                    <tr>
                        <th>Product merk</th>
                        <th>Product titel</th>
                        <th>Beschrijving</th>
                        <th>Hoeveelheid</th>
                        <th>Categorie</th>
                        <th>Product afeelding</th>
                        <th>Verwijderen</th>
                        <th>Bijwerken</th>
                        
                    </tr>
                    @foreach($products as $product)
                    <tr>
                        <td>{{$product->Merk}}</td>
                        <td>{{$product->title}}</td>
                        <td>{!!Str::limit($product->description, 50)!!}</td>
                        <td>{{$product->all}}</td>
                        <td>{{$product->categorie->cat_title}}</td>
                        <td><img src="producten_images/{{$product->product_img}}" style="width: 100px; height: 100px;"></td>
                        <td><a onclick="confirmation(event)" href="{{url('product_delete', $product->id)}}" class="btn btn-danger">Verwijder</a></td>
                        <td><a href="{{url('update_product', $product->id)}}"class="btn btn-info">Bijwerken</a></td>
                      </tr>
                    @endforeach


                </table>


            </div>



          </div>
        </div>
      </div>


    @include('admin.footer')
      <script type="text/javascript">
            function confirmation(ev){
              ev.preventDefault();
              var urlToRedirect = ev.currentTarget.getAttribute('href');
              console.log(urlToRedirect);
          swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this data!",
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