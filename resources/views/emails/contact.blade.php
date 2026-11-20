<p>Vous avez reçu un nouveau message depuis votre portfolio.</p>
<p><strong>Nom :</strong> {{ $contact->name }}</p>
<p><strong>Email :</strong> {{ $contact->email }}</p>
<p><strong>Message :</strong></p>
<p>{!! nl2br(e($contact->body)) !!}</p>
<p>Répondez directement à cet email pour écrire à {{ $contact->name }}.</p>
