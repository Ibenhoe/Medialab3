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
      #calendar {
        border-collapse: collapse;
        width: 100%;
      }
      #calendar td, #calendar th {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: center;
      }
      #calendar tr:nth-child(even){background-color: #f2f2f2;}
      #calendar th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: center;
        background-color: #4CAF50;
        
      }
      #monthYear {
        color: black;
      }
      .selected {
        background-color: #abcdef;
      }
      .blocked {
        pointer-events: none;
        text-decoration: line-through;
      }
      .heleKalenderDiv {
          width:fit-content;
          border: 1px solid black;
          width: 400px;
          background-color: white;
          margin-left: auto;
          margin-right: auto;
          color: black;
          padding: 1em;
          border-radius: 10px;
          margin-bottom: 1em;
          
          
      }
      .knop1 {
        background-color: #e30613;
        width: 92%;
        color: white;
        font-size: larger;
        margin-left: 1em;
        margin-right: 1em;
        padding: 1em;
        border-radius: 1em;
        font-weight: 600;
      }
      .bovenKalender {
        display: flex;
        justify-content: space-between;
        align-items: center;
        
      }
      button {
        background-color: #e30613;
        border: none;
        color: white;
        font-weight: 600;
      }
      .dropDownDingen {
        margin-top: 1.2em;
        display: flex;
        padding-left: 1em;
        padding-right: 1em;
        justify-content: space-between;
      }
      .leejbel {
         margin-top: auto;
          margin-bottom: auto;
          color: white;
          font-weight: 600;
      }
      ._select select {
        background-color: #e30613;
        border: none;
        border-radius: 2em;
        color: white;
        font-weight: 600;
      }
    </style>
    
  </head>

<body>

  @include('home.headerdetailspage')
  <!-- ***** Header Area End ***** -->
  <div class="discover-items">
    <div class="container">
    <div class="volledigeDiv">
        <div class="linkerDiv">
            <div class="fotoDiv"><img src="/producten_images/{{$data->product_img}}"></div>
            <hr>
            <div class="balkjeOnderFoto">
                <p>{{$data->Merk}} {{$data->title}}</p>
                <div class="favorietenDiv">
                    <div><a href="{{url('add_favorites', $data->id)}}"><p>Favorieten</p></a></div>
                    <div><a href="{{url('add_favorites', $data->id)}}"><img src="assets/images/favorieten-white.png" alt="" style="max-width: 35px;" ></a></div>
                </div>
            </div>
            <hr>
            <div class="productBeschrijving">
                <h1>Beschrijving</h1>
                <p>{{$data->description}}</p>
            </div>
            
        </div>

 
        <div class="rechterDiv">
            <div class="bovenDiv">
            <form action="{{ url('reservation') }}" method="POST" id="reservationForm" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="product_id" value="{{ $data->id}}"> <!-- Gebruik dynamische product ID -->
            <input type="hidden" name="user_id" value="{{ Auth::id() }}"> <!-- Ingelogde user ID -->
            

            <div class="heleKalenderDiv">
                <div class="bovenKalender">
                    <div><button type="button" id="prevMonth">&#60;</button></div>
                    <div><h2 id="monthYear"></h2></div>
                    <div><button type="button" id="nextMonth">&gt;</button></div>
                </div>
                <table id="calendar">
                    <!-- De kalender wordt hier dynamisch gegenereerd -->
                </table>
            </div>
            
            <div class="dropDownDingen">
              <div class="leejbel"><label>Reden van uitleen:</label></div>
              <div class="_select">
                <select name="reason" id="reason" required>
                    <option value="">Kies een optie...&nbsp;&nbsp;&nbsp;</option>
                    <option value="Project">Project</option>
                    <option value="Vrije tijd">Vrije tijd</option>
                    <option value="Eindwerk">Eindwerk</option>
                    <option value="Andere">Andere</option>
                </select>
              </div>
            </div>
            <label for="start_date"> </label>
            <input type="date" name="start_date" id="start_date"style="display: none;"  required>

            <label for="end_date"> </label>
            <input type="date" name="end_date" id="end_date"style="display: none;"   required>
            

            <div class="knop1">
                <button type="submit">Reserveren en toevoegen aan mandje</button>
            </div>
        </form>
          
        </div>
    </div>
      </div>
    </div>
  </div>
</div>
  @include('home.footer')
  <script src="assets/js/calender.js"></script>


  </body>
</html>