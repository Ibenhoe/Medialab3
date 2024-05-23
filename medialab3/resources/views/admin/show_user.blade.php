<!DOCTYPE html>
<html>
  <head> 
    @include('admin.css')
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
    </style>
  </head>
  <body>
    @include('admin.header')
    <div class="d-flex align-items-stretch">
    @include('admin.sidebar')
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
                <h1>User lijst</h1>
                <table class="div_left">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        
            
                    </tr>
                    @foreach($data as $datas)
                    <tr>
                        <td>{{$datas->name}}</td>
                        <td>{{$datas->email}}</td>
                        
                        <td><a href="{{url('blacklist', $datas->id)}}"class="btn btn-info">Blacklist</a></td>
                      </tr>
                    @endforeach


                </table>


            </div>



          </div>
        


          </div>
        </div>
    </div>
      
    @include('admin.footer')
  </body>
</html>