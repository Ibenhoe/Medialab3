<!DOCTYPE html>
<html>

<head>
    @include('admin.css')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <style type="text/css">
        .div_left {
            margin-left: 20px;
        }

        label {
            display: inline-block;
            width: 200px;
        }

        .div_pad {
            padding: 10px;
        }

        .page-content {
            background-color: #2d3035;
        }
        .onderDivKnop2 {
            background-color: #e30613;
            width: 40px;
            height: 40px;
            margin-top: auto;
            margin-bottom: auto;
            margin-right: 2em;
            border-radius: 2em;
            margin: 0.3em;
            margin-left: auto;
            margin-right: 2em;
        }

        .onderDivKnop2:hover {
            filter: brightness(80%);
        }

        .onderDivKnop2 img {
            width: 40px;
            width: 40px;
        }
        .product-naam {
            font-size: 20px !important;
        }
        #product_name {
            background-color: #282b2f !important;
            border-radius: 2em !important;
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
                    <div class="div_left">
                        <h1 class="h2">Genereer een serienummer voor een item</h1>
                        <form method="GET" action="{{ url('add_item') }}">
                            @csrf
                            <div class="div_pad">
                                <label class="product-naam" for="product_name">Product naam</label>
                                <select name="product_name" id="product_name" required onchange="this.form.submit()">
                                    <option value="0" {{ old('product_name', request('product_name')) == 0 ? 'selected' : '' }}>Selecteer een Product</option>
                                    @foreach ($data as $item)
                                        <option value="{{ $item->id }}" {{ old('product_name', request('product_name')) == $item->id ? 'selected' : '' }}>
                                            {{ $item->Merk }} {{ $item->title }} 
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </form>

                        @if(request('product_name') && request('product_name') != 0)
                            <table class="table mt-3">
                                <thead>
                                    <tr>
                                        <th>Serienummer</th>
                                        <th>Beschikbaarheid</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($items as $item)
                                        <tr>
                                            <td>{{ $item->serial_number }}</td>
                                            <td>{{ $item->availability ? 'Beschikbaar' : 'Niet beschikbaar' }}</td>
                                            <td><div class="onderDivKnop2"><a onclick="confirmation(event)" href="{{ url('delete_item', $item->item_id)}}"><img src="assets/images/vuilbakje.png"></a></div></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <form method="POST" action="{{ url('generate_serial') }}" class="mt-3">
                                @csrf
                                <input type="hidden" name="product_name" value="{{ request('product_name') }}">
                                <div class="div_pad">
                                    <label for="serial_number">Genereer serienummer</label>
                                    <button type="submit" class="btn btn-primary">Genereer</button>
                                </div>
                            </form>
                        @endif

                        @if (session('serial_number'))
                            <div class="alert alert-success mt-3">
                                Serienummer gegenereerd: {{ session('serial_number') }}
                            </div>
                        @endif
                        
                    </div>
                </div>
            </div>
        </div>
        @include('admin.footer')
    </div>
    <script type="text/javascript">
            function confirmation(ev){
              ev.preventDefault();
              var urlToRedirect = ev.currentTarget.getAttribute('href');
              console.log(urlToRedirect);
          swal({
                title: "Ben je zeker?",
                text: "Eenmaal verwijder zal de serial number niet meer beschikbaar zijn!",
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
