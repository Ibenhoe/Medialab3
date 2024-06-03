<!DOCTYPE html>
<html>
  <head> 
    @include('admin.css')
    <style type="text/css">
      
        th{
            padding: 20px;
            font-weight: bold;
            font-size: 12px;
            border-bottom: 3px solid grey;
        }
        td{
            padding: 10px;
            border-bottom: 1px solid grey;
        }
        .page-content {
          background-color: #2d3035;
        }
        .btn-btn-warning {
          color: white;
          background-color: green;
          padding: 5px 5px;
          border-radius: 5px;
          margin-bottom: 5px;
        }
        .btn-btn-warning:hover {
          color: white;
          text-decoration: none;
          filter: brightness(80%);
        }
        .btn-btn-danger {
          color: white;
          background-color: red;
          padding: 5px 5px;
          border-radius: 5px;
          margin-bottom: 5px;
        }
        .btn-btn-danger:hover {
          color: white;
          text-decoration: none;
          filter: brightness(80%);
        }
        .btn-btn-info {
          color: white;
          background-color: #f0ad4e;
          padding: 5px 10px;
          border-radius: 5px;
          margin-bottom: 5px;
        }
        .btn-btn-info:hover {
          color: white;
          text-decoration: none;
          filter: brightness(80%);
        }
        .minderBreed {
          font-size: 13px;
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
          <div class="actions">
                <a href="{{ url('outgoing_products') }}" class="btn btn-primary">Uitgaande Producten</a>
                <a href="{{ url('incoming_products') }}" class="btn btn-success">Binnenkomende Producten</a>
            </div>
            <div class="table_request">
            <table >
              <tr>
                <th>Gebruikernaam</th>
                <th>Email</th>
                <th>Product titel</th>
                <th>Serial nummer</th>
                <th>Uitleen/ retour datum</th>
                <th>Schade</th>
                <th>Status</th>
                <th>Product afbeelding</th>
                <th>Verander status</th>
              </tr>

              @foreach($data as $borrow)
              <tr>
                <td class="minderBreed">{{$borrow->user->name}}</td>
                <td class="minderBreed">{{$borrow->user->email}}</td>
                <td class="minderBreed">{{$borrow->product->Merk}} {{$borrow->product->title}}</td>
                <td class="minderBreed">{{$borrow->item->serial_number}}</td>
                <td class="minderBreed"><p>{{$borrow->start_date}}</p><p> / {{$borrow->end_date}}</p></td>
                <td class="minderBreed">{{$borrow->defect}}</td>
                <td class="minderBreed">{{$borrow->status}}</td>
                <td><img src="producten_images/{{$borrow->product->product_img}}" style="width: 100px; height: 100px;"></td>

                @if ($borrow->status == 'approved')
                    <td><a class="btn-btn-warning" disabled>Accepteren</a>
                      <a class="btn-btn-danger"disabled>Afwijzen</a>
                      <a class="btn-btn-info" href="{{url('returned_product',$borrow->id)}}">Terug gebracht</a></td>
                @elseif ($borrow->status == 'pending')
                    <td><a class="btn-btn-warning" href="{{url('approved_product',$borrow->id)}}">Accepteren</a>
                      <a class="btn-btn-danger" href="{{url('rejected_product',$borrow->id)}}">Afwijzen</a>
                      <a class="btn-btn-info" disabled>Terug gebracht</a></td>
                @endif
                </td>
              </tr>
              @endforeach
            </table>
          </div>
        </div>
      </div>
    </div>
      
    @include('admin.footer')
  </body>
</html>