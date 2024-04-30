<!DOCTYPE html>
<html lang="en">

  <head>
    @include('home.css')
    
  </head>

<body>

  @include('home.header')
  <!-- ***** Header Area End ***** -->

  <div class="discover-items">
    <div class="container">
      <div class="row">
      <div class="item-details-page">
        
            @foreach($data as $datas)
            <tr>
                <td>{{$datas->product->title}}</td>
            <td>
                <a class="btn btn-info" href="">Edit</a>
                <a onclick="confirmation(event)" class="btn btn-danger" href="">Delete</a>
            </td>
            </tr>
            
            @endforeach
            </table>
          </div>
        </div>
  </div>
  </div>

  @include('home.footer')

  </body>
</html>