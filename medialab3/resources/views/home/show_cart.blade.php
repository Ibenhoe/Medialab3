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
.tekstDiv2 {
  display:grid;
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
}
.onderDivKnop2:hover {
  filter: brightness(80%);
}
.onderDivKnop2 img{
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
}
.knopDiv2:hover {
  filter: brightness(80%);
}
.knopDiv2 a{
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



  </style>

<body>

  @include('home.header')
  <!-- ***** Header Area End ***** -->
  <div class="discover-items" style="padding-top: 140px;">
    <div class="container">
      <div class="row">
  <h1 class="winkelmandText">Uitleen mandje</h1>
    <div class="volledigeDiv2">
      <div class="containerDiv2">
        <div class="linkerDiv2">
          <div class="artikelDiv2">
            <div class="bovenDiv2">
              <div class="imgDiv2"><img src="../../images/HPprobook.png"></div>
              <div class="tekstDiv2">
                <h2>HP Probook 17</h2>
                <p>Intel 11th gen 14900K<br>16GB ram</p>
              </div>
            </div>
            <div class="onderDiv2">
              <p class="onderDivTekst2">Uitleendatum: 25/10/2024<br>Retourdatum: 5/11/2024</p>
              <div class="onderDivKnop2"><a href="#"><img src="../../images/vuilbakje.png"></a></div>
            </div>
          </div>
        </div>
        
        
      </div>

      <div class="rechterDiv2">
        <div class="rechterDivje2">
          <div class="artikelLijst2">
            <p class="artikelNaam2">HP Probook</p>
            <p class="artikelNaam2">Macbook Pro M1 13"</p>
            <p class="artikelNaam2">Vive 2</p>
            <p class="artikelNaam2">Oculus Rift 420</p>
          </div>
          <div class="knopDiv2">
            <a href="../user/Main.html">Reservering bevestigen</a>
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