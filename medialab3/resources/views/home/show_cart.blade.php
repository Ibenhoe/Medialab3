<!DOCTYPE html>
<html lang="en">

<head>
  @include('home.css')
</head>

<style>
  .volledigeDiv2 {
    display: flex;
  }

  .containerDiv2 {
    width: 58%;
    margin-top: 1em;
  }

  .linkerDiv2 {
    width: 100%;
    height: fit-content;
  }

  .artikelDiv2 {
    background-color: #282b2f;
    border-radius: 2em;
    margin: 1em;
    margin-top: 0;
  }

  .bovenDiv2 {
    display: flex;
  }

  .bovenDiv2 img {
    width: 100%;
  }

  .imgDiv2 {
    width: 40%;
    height: 40%;
    padding: 1em;
  }

  .imgDiv2 img {
    width: max-content;
    border-radius: 1em;
    margin-left: auto;
    margin-right: auto;
    margin-top: auto;
    margin-bottom: auto;
  }

  .tekstDiv2 {
    display: grid;
    border-left: 1px solid gray;
    padding: 1em;
  }

  .tekstDiv2 h2 {
    font-size: x-large;
  }

  .tekstDiv2 p {
    font-size: larger;
  }

  .onderDiv2 {
    border-top: 1px solid gray;
    display: flex;
    justify-content: space-between;
  }

  .onderDivTekst2 {
    font-size: larger;
    padding: 0em 1em 0.5em 1em;
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

  .rechterDiv2 {
    background-color: #282b2f;
    border-radius: 2em;
    width: 38%;
    height: fit-content;
    padding: 1em;
    margin-top: 1em;
  }

  .artikelLijst2 {
    margin: 1em;
  }

  .artikelNaam2 {
    font-size: larger;
    border-bottom: 1px solid gray;
  }

  .knopDiv2 {
    background-color: #e30613;
    display: flex;
    justify-content: center;
    border-radius: 1em;
    font-size: x-large;
    color: white;
    font-weight: 600;
  }

  .knopDiv2 button {
    padding: 1em;
    width: 100%;
    height: 100%;
  }

  .knopDiv2:hover {
    filter: brightness(80%);
  }

  .knopDiv2 a {
    text-decoration: none;
    color: white;
    font-size: x-large;
    font-weight: 700;
    padding: 1em;
  }

  .winkelmandText {
    font-size: xx-large;
    margin-left: 1em;
  }

  .datumselectDiv {
    display: flex;
  }

  .begindatumDiv input {
    width: 17em;
    border: none;
    border-radius: 2em;
  }

  .einddatumDiv input {
    width: 17em;
    border: none;
    border-radius: 2em;
  }

  select {
    border: none;
    border-radius: 2em;
  }
</style>

<body>
  @include('home.header')
  <div class="discover-items" style="padding-top: 140px;">
    <div class="container">
      <div class="row">
        <h1 class="winkelmandText">Uitleen mandje</h1>
        <div class="volledigeDiv2">
          <div class="containerDiv2">

            <!-- Reservation cart -->
            <div class="linkerDiv2">
              <form action="{{ url('confirm_reservation') }}" method="POST">
                @csrf
                @foreach($data as $datas)
                <div class="artikelDiv2">
                  <div class="bovenDiv2">
                    <div class="imgDiv2"><img src="/producten_images/{{ $datas->product->product_img }}" style="max-width: 200px;"></div>
                    <div class="tekstDiv2">
                      <h2>{{ $datas->product->Merk }} {{ $datas->product->title }}</h2>
                      <p>{!! Str::limit($datas->product->description, 90) !!}</p>
                      <input type="hidden" name="product_ids[]" value="{{ $datas->product->id }}">

                      <!-- Date selector -->
                      <div class="datumselectDiv">
                        <div class="begindatumDiv">
                          <label for="start_date_{{ $datas->id }}">Startdatum:</label>
                          <input type="date" id="start_date_{{ $datas->id }}" name="start_date[{{ $datas->product->id }}]" required>
                        </div>
                        <div class="einddatumDiv">
                          <label for="end_date_{{ $datas->id }}">Einddatum:</label>
                          <input type="date" id="end_date_{{ $datas->id }}" name="end_date[{{ $datas->product->id }}]" required>
                        </div>
                      </div>

                      <!-- Reason selector -->
                      <label for="reason">Reden:</label>
                      <select name="reason" id="reason" required>
                        <option value="">Kies een reden</option>
                        <option value="Project">Project</option>
                        <option value="Vrije tijd">Vrije tijd</option>
                        <option value="Eindwerk">Eindwerk</option>
                        <option value="Andere">Andere</option>
                      </select>
                    </div>
                  </div>

                  <!-- Delete button product -->
                  <div class="onderDiv2">
                    <div class="onderDivKnop2"><a href="{{ url('delete_cart', $datas->id) }}"><img src="assets/images/vuilbakje.png"></a></div>
                  </div>
                </div>
                @endforeach

            </div>
          </div>
          <!-- List of product right -->
          <div class="rechterDiv2">
            <div class="rechterDivje2">
              @foreach($data as $datas)
              <div class="artikelLijst2">
                <p class="artikelNaam2">{{ $datas->product->Merk }} {{ $datas->product->title }}</p>
              </div>

              @endforeach

              <!-- Submit button reservation -->
              <div class="knopDiv2">
                <button type="submit">Reservering bevestigen</button>
              </div>

            </div>
          </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  @include('home.footer')
  
  
</body>

</html>