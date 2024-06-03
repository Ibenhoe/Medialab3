@component('mail::message')
<p>Beste {{ $user->name }},</p>
<p>Hartelijk dank voor het gebruikmaken van onze uitleendienst. Dit is een bevestiging van de items die u heeft geleend.</p>

    <div style="background-color: #f5f5f5; padding: 20px; border-radius: 5px;">
        <p><strong>Product:</strong> {{ $product->Merk }} {{ $product->title }}</p>
        <p><strong>Reden:</strong> {{ $reservation->reason }}</p>
        <p><strong>Serienummer:</strong> {{ $item->serial_number }}</p>
        <p><strong>Begindatum:</strong> {{ $reservation->start_date }}</p>
        <p><strong>Retourdatum:</strong> {{ $reservation->end_date }}</p>
    </div>


<p>U kan deze items de eerst volgende maandag komen oppikken in het MediaLab.</p>

<p><b>Uitleenvoorwaarden:</p></b>   

<li>De geleende items dienen in dezelfde staat te worden geretourneerd als waarin ze zijn ontvangen.</li>
<li>Indien de items niet op tijd worden geretourneerd, kan er een verbanning van toepassing zijn.</li>
<li>Bij beschadiging of verlies van de items kunnen er vervangingskosten in rekening worden gebracht.</li>

<p><b>Retourlocatie:</b></p>

<p>Het retourneren van items kan enkel vrijdag tussen 10:00-12:00 en tussen 12:30-17:00 in het Medialab op campus Kaai.</p>

<p><b>Contact:</b></p>

<p>Als u vragen heeft over uw uitleenaanvraag of als er problemen zijn met de geleende items, neem dan contact op met onze uitleendienst via: gdt.kaai.student@ehb.be, <u>02 523 37 37</u> of kom even ter plaatsen.</p>

<p>Wij danken u voor uw medewerking en wensen u veel succes met het gebruik van de geleende items.</p>

<p>Met vriendelijke groet,</p>

<p>Uitleendienst Erasmushogeschool Brussel.</p>