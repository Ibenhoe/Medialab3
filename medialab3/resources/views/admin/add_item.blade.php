<!DOCTYPE html>
<html>

<head>
    @include('admin.css')

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
                        <h1 class="h2">Generate Serial Number for item</h1>
                        <form method="POST" action="{{ url('generate_serial') }}">
                            @csrf
                            <div class="div_pad">
                                <label for="product_name">Product name</label>
                                <select name="product_name" id="product_name" required onchange="this.form.submit()">
                                    <option value="0" {{ old('product_name') == 0 ? 'selected' : '' }}>Select a Product</option>
                                    @foreach ($data as $item)
                                        <option value="{{ $item->id }}" {{ old('product_name') == $item->id ? 'selected' : '' }}>
                                            {{ $item->title }} {{ $item->Merk }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </form>
                        @if(old('product_name') && old('product_name') != 0)
                        <form method="POST" action="{{ url('generate_serial') }}">
                            @csrf
                            <input type="hidden" name="product_name" value="{{ old('product_name') }}">
                            <div class="div_pad">
                                <label for="serial_number">Serial Number</label>
                                <button type="submit" class="btn btn-primary">Generate</button>
                            </div>
                        </form>
                        @endif
                        @if (session('serial_number'))
                            <div class="alert alert-success mt-3">
                                Serial Number Generated: {{ session('serial_number') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @include('admin.footer')
    </div>
</body>

</html>
