<!DOCTYPE html>
<html lang="en">

<head>
@include('home.css')
<style>
.logo{
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


    </style>
  </head>
<body>
  @include('home.header')
  <!-- ***** Header Area End ***** -->
  <div class="discover-items" style="padding-top: 140px;">
    <div class="container">
      <div class="row">
  <div class="allesDiv">
    <h1 class="titel">Mijn reserveringen</h1>
    @foreach($data as $datas)
    <div class="lijstDiv">
      
      <div class="naamDiv">
        <p>{{$datas->product->Merk}} {{$datas->product->title}}</p>
        <p class="uitleenDatum" href="#">Uitgeleend tot: {{$datas->end_date}}</p>
        
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