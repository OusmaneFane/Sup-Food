{{-- resources/views/emails/payment_confirmation.blade.php --}}

<p>Bonjour {{ $command->user->name }},</p>

<p>Votre paiement pour la commande #{{ $command->id }} a été enregistré avec succès.</p>

<p>Merci pour votre confiance. Vous trouverez ci-joint le reçu de paiement.</p>

<p>— L’équipe SUP'FOOD</p>
