<!DOCTYPE html>
<html lang="en">

<head>
  @include('home.css')
  <style>
    .logo {
      width: 3.5rem;
    }

    .allesDiv {
      margin: 1em;
      margin-top: 0;
      border-radius: 2em;
      padding-bottom: 2em;
      padding-top: 0;
    }

    .titel {
      font-size: xx-large;
      width: fit-content;
      padding: 0.6em;
      border-radius: 0.6em;
    }

    .naamDiv {
      display: flex;
      justify-content: space-between;
      background-color: rgb(194, 194, 194);
      margin: 1em 2em 1em 2em;
      border-radius: 2em;
      height: 3em;

    }

    .naamDiv p {
      margin-top: auto;
      margin-bottom: auto;
      margin-left: 1em;
      font-size: large;
      font-weight: 600;
      color: black;
    }

    .naamDiv a:hover {
      filter: brightness(80%);
    }

    .uitleenDatum {
      margin-top: auto;
      margin-bottom: auto;
      margin-right: 0;
      text-decoration: none;
      color: white;
      background-color: #e30613;
      padding: 0.5em 1em 0.5em 1em;
      border-radius: 2em;
    }

    .uitleenDatum:last-child {
      color: white;
    }
    .rechterStuk{
      display: flex;
    }
    .verlengKnop{
      background-color: #7453fc;
      margin-top: auto;
      margin-bottom: auto;
      padding: 0.5em;
      border-radius: 0.5em;
      color: white;
      font-weight: 600;
    }
    .verlengKnop:hover{
      filter: brightness(80%);
      color: white;
    }
    .schadeKnop{
      background-color: #7453fc;
      margin-left: 0.3em;
      margin-top: auto;
      margin-bottom: auto;
      padding: 0.5em;
      border-radius: 0.5em;
      color: white;
      font-weight: 600;
    }
    .schadeKnop:hover{
      filter: brightness(80%);
      color: white;
    }
  </style>
</head>

<body>
  @include('home.header')

  <!-- List of product reservation-->
  <div class="discover-items" style="padding-top: 140px;">
    <div class="container">
      <div class="row">
        <div class="allesDiv">
          <h1 class="titel">Mijn reserveringen</h1>

          <!-- Reservated product -->
          @foreach($data as $datas)

          <div class="lijstDiv">
            <div class="naamDiv">
              <p>{{$datas->product->Merk}} {{$datas->product->title}}</p>
              <div class="rechterStuk">
                <a href="#" class="verlengKnop">Verlengen</a>
                <a href="#" class="schadeKnop">Schade melden</a>
                <p class="uitleenDatum" href="#">Uitgeleend tot: {{$datas->end_date}}</p>
              </div>
            </div>
          </div>

          @endforeach

        </div>
      </div>
    </div>
  </div>

  @include('home.footer')
</body>

</html>