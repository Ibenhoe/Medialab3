<div class="currently-market">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">  
        </div>
        <div class="col-lg-12">
          <div class="row grid">
            @foreach($data as $data1)
            <div class="col-lg-6 currently-market-item all msc">
              <div class="item">
                <div class="left-image">
                  <img src="producten_images/{{$data1->product_img}}" alt="" style="border-radius: 20px; min-width: 195px; max-width: 195px">
                </div>
                <div class="right-content">
                  <h4>{{$data1->Merk}} {{$data1->title}}</h4>
                  
                  <div class="line-dec"></div>
                  <span class="bid">
                    Beschikbaar<br><strong>{{$data1->getRemainingAttribute()}}</strong><br> 
                  </span>
                  <span class="ends">
                    Totaal<br><strong>{{$data1->getAllAttribute()}}</strong><br>
                  </span>
                  <div class="text-button">
                    <a href="{{url('details_product',$data1->id)}}">Bekijk product</a>
                    <a style="color: white;float: right; display:flex; background-color: #e30613; border: 1px solid #e30613;" class="btn btn-primary" href="{{url('add_cart', $data1->id)}}" >+<img src="assets/images/winkelmandje-white.png" alt="" style="max-width: 25px;" ></a>
                  </div>
                  <br>
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>
        {{$data->links()}}
      </div>
    </div>
  </div>