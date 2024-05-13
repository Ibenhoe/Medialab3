<div class="currently-market">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div class="section-heading">
            <div class="line-dec"></div>
            <h2><em>Bekijk</em> alles wat beschikbaar is.</h2>
          </div>
        </div>

        
          @if(session()->has('message'))
          <div class="alert alert-success">
            <button type="button" class="close" data-bs-dissmis="alert" aria-hidden="true" >x</button>
          @endif
        
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
                    Current Available<br><strong>{{$data1->Quantity}}</strong><br> 
                  </span>
                  <span class="ends">
                    Total<br><strong>{{$data1->Quantity}}</strong><br>
                  </span>
                  <div class="text-button">
                    <a href="{{url('details_product',$data1->id)}}">Bekijk product</a>
                  </div>
                  <br>

                  <div>
                    <a class="btn btn-primary" href="{{url('add_cart', $data1->id)}}">Voeg toe aan winkelmandje</a>
                  </div>




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