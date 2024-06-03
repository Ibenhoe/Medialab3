@component('mail::message')
<p>Beste {{ $user->name }},</p>

<p>Hartelijk dank voor het gebruikmaken van onze uitleendienst. Helaas moeten wij u mededelen dat uw reservering voor het volgende item is afgewezen:</p>

<div style="background-color: #f5f5f5; padding: 20px; border-radius: 5px;">
    <p><strong>Product:</strong> {{ $product->Merk }} {{ $product->title }}</p>
    <p><strong>Reden:</strong> {{ $reservation->reason }}</p>
    <p><strong>Periode:</strong> {{$reservation->start_date}} - {{$reservation->end_date}}</p>
</div>

<p>We begrijpen dat dit mogelijk ongemak veroorzaakt en bieden onze excuses aan voor het ongemak. U kunt een nieuwe reservering maken via onze uitleendienst of contact opnemen voor meer informatie.</p>

<p><b>Uitleenvoorwaarden:</p></b>

<li>De geleende items dienen in dezelfde staat te worden geretourneerd als waarin ze zijn ontvangen.</li>
<li>Indien de items niet op tijd worden geretourneerd, kan er een verbanning van toepassing zijn.</li>
<li>Bij beschadiging of verlies van de items kunnen er vervangingskosten in rekening worden gebracht.</li>

<p><b>Retourlocatie:</b></p>

<p>Het retourneren van items kan enkel vrijdag tussen 10:00-12:00 en tussen 12:30-17:00 in het Medialab op campus Kaai.</p>

<p><b>Contact:</b></p>

<p>Als u vragen heeft over uw uitleenaanvraag of als er problemen zijn met de geleende items, neem dan contact op met onze uitleendienst via: gdt.kaai.student@ehb.be, <u>02 523 37 37</u> of kom even ter plaatse.</p>

<p>Wij danken u voor uw medewerking en wensen u veel succes met het gebruik van de geleende items.</p>

<p>Met vriendelijke groet,</p>

<p>Uitleendienst Erasmushogeschool Brussel.</p>
