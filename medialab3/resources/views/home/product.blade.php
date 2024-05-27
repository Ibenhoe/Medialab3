<div class="currently-market">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          
        </div>

        
          @if(session()->has('message'))
          <div class="alert alert-success">
            <button type="button" class="close" data-bs-dissmis="alert" aria-hidden="true" >x</button>
          @endif
        
        
        <div class="col-lg-12">
          <div class="row grid">
            


            @foreach($products as $product)
            <div class="col-lg-6 currently-market-item all msc">
              <div class="item">
                <div class="left-image">
                  <img src="producten_images/{{$product->product_img}}" alt="" style="border-radius: 20px; min-width: 195px; max-width: 195px">
                </div>
                <div class="right-content">
                  <h4>{{$product->Merk}} {{$product->title}}</h4>
                  
                  <div class="line-dec"></div>
                  <span class="bid">
                    Beschikbaar<br><strong>{{$product->remaining}}</strong><br> 
                  </span>
                  <span class="ends">
                    Totaal<br><strong>{{$product->Quantity}}</strong><br>
                  </span>
                  <div class="text-button">
                    <a href="{{url('details_product',$product->id)}}">Bekijk product</a>
                    <a style="color: white;float: right; display:flex; background-color: #e30613; border: 1px solid #e30613;" class="btn btn-primary" href="{{url('add_cart', $product->id)}}" >+<img src="assets/images/winkelmandje-white.png" alt="" style="max-width: 25px;" ></a>
                  </div>
                  <br>
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>
        {{$products->links()}}
      </div>
    </div>
  </div>