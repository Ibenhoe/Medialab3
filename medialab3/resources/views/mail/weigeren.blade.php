@component('mail::message')

<p>Beste {{ $user->name }},</p>

<p>Helaas moeten wij u informeren dat uw uitleenaanvraag voor het volgende item is geweigerd:</p>

<div style="background-color: #f5f5f5; padding: 20px; border-radius: 5px;">
    <p><strong>Product:</strong> {{ $product->Merk }} {{ $product->title }}</p>
    <p><strong>Begindatum:</strong> {{ $reservation->start_date }}</p>
    <p><strong>Retourdatum:</strong> {{ $reservation->end_date }}</p>
</div>

<p>Als u vragen heeft over de weigering of als u een nieuwe aanvraag wilt indienen, neem dan gerust contact met ons op via: gdt.kaai.student@ehb.be, <u>02 523 37 37</u>, of kom langs op onze locatie.</p>

<p>Met vriendelijke groet,</p>

<p>Uitleendienst Erasmushogeschool Brussel</p>