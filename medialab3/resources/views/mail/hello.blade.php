@component('mail::message')
<p>Beste {{ $user->name }},</p>
<p>Hartelijk dank voor het indienen van uw uitleenaanvraag bij onze uitleendienst. Wij hebben uw aanvraag in goede orde ontvangen en zullen deze zo spoedig mogelijk verwerken. Hieronder vindt u de details van uw aanvraag:</p>

<div style="background-color: #f5f5f5; padding: 20px; border-radius: 5px;">
    <p><strong>Product:</strong> {{ $product->Merk }} {{ $product->title }}</p>
    <p><strong>Reden:</strong> {{ $reservation->reason }}</p>
    <p><strong>Begindatum:</strong> {{ $reservation->start_date }}</p>
    <p><strong>Retourdatum:</strong> {{ $reservation->end_date }}</p>
</div>

<p>Wij zullen uw aanvraag beoordelen en u zo snel mogelijk laten weten of de items beschikbaar zijn voor de door u opgegeven periode. U ontvangt een bevestigingsmail zodra de aanvraag is goedgekeurd.</p>
<p>Mocht u in de tussentijd vragen hebben over uw aanvraag of aanvullende informatie willen verstrekken, neem dan gerust contact met ons op via: gdt.kaai.student@ehb.be, <u>02 523 37 37</u>, of kom langs op onze locatie.</p>

<p>Met vriendelijke groet,</p>

<p>Uitleendienst Erasmushogeschool Brussel</p>
