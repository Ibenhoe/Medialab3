<div class="currently-market">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div class="section-heading">
            <div class="line-dec"></div>
            <h2><em>Items</em> Currently In The Market.</h2>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="filters">
            <ul>
              <li data-filter="*"  class="active">All Books</li>
              <li data-filter=".msc">Popular</li>
              <li data-filter=".dig">Latest</li>
              
            </ul>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="row grid">
            


            @foreach($data as $data)

            <div class="col-lg-6 currently-market-item all msc">
              <div class="item">
                <div class="left-image">
                  <img src="producten_images/{{$data->product_img}}" alt="" style="border-radius: 20px; min-width: 195px; max-width: 195px">
                </div>
                <div class="right-content">
                  <h4>{{$data->Merk}} {{$data->title}}</h4>
                  
                  <div class="line-dec"></div>
                  <span class="bid">
                    Current Available<br><strong>{{$data->Quantity}}</strong><br> 
                  </span>
                  <span class="ends">
                    Total<br><strong>{{$data->Quantity}}</strong><br>
                  </span>
                  <div class="text-button">
                    <a href="{{url('product_details',$data->id)}}">Bekijk product</a>
                  </div>
                  <br>

                  <div class="">
                    <a class="btn btn-primary" href="{{url('borrow_product', $data->id)}}">Meld je aan</a>
                  </div>




                </div>
              </div>
            </div>
            @endforeach
            

            

          </div>
        </div>
      </div>
    </div>
  </div>