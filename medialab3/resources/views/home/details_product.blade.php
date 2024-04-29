<!DOCTYPE html>
<html lang="en">

  <head>
    <base href="/public">
    @include('home.css')
    <style>
      .col-lg-5 align-self-center{
        display: flex;
        flex-direction: column;
      }
      .col-lg-7{
        display: flex;
        flex-direction: column;
      }
      .item-details-page h4{
        margin-top: 25px;
      }
      .discover-items{
        padding: 120px 0 20px 0;
      }
    </style>
    
  </head>

<body>

  @include('home.header')
  <!-- ***** Header Area End ***** -->
  <div class="discover-items">
    <div class="container">
      <div class="row">
      <div class="item-details-page">

    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="section-heading">
            <div class="line-dec"></div>
            <h2>View Details <em>For Item</em> Here.</h2>
          </div>
        </div>
        <div class="col-lg-7">
          <div class="left-image">
            <img src="/producten_images/{{$data->product_img}}" alt="" style="border-radius: 20px; min-width: 400px; max-width: 500px">
          </div>
        </div>
        <div class="row">
          <div class="col-6">
              <span class="bid">Available<br><strong>10</strong><br></span>
            </div>
            <div class="col-6">
              <label for="lease-date">Choose Lease Date:</label>
              <input type="date" id="lease-date" name="lease-date">
        </div>
      </div>

        <div class="row">
                <div class="col-12">
                  <h4>{{$data->Merk}} {{$data->title}}</h4>
                  <p>{{$data->description}}</p>
                </div>
              </div>
              <div class="row">
                <div class="col-6">
                  <span class="bid">Available<br><strong>10</strong><br></span>
                </div>
          </div>
          
        </div>
        
  </div>
    </div>
      </div>


      </div>
    </div>
  </div>
  
  
 

  @include('home.footer')

  </body>
</html>