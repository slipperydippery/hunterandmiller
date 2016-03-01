@extends('layouts.master')

@section('content')

<div class="row">
    <div class="column">
        <h2 class="page__ttl">Contact</h2>

			<p>Voel je vrij contact met ons op te nemen:</p>

			<form action="feedback.php" method="post" class="contact__form">
				<p><label for="name_field">Naam</label><input type="text" name="fullname" id="name_field" size="40" /></p>
				<p><label for="email_field">Email</label><input type="text" id="email_field" name="email" size="40" /></p>

				<p><label for="comment_field">Bericht</label>
				<textarea name="comments" id="comment_field" class="contact__comment_field"></textarea></p>
				<input type="submit" class="button" value="Verstuur" /><br />
			</form>


			<div class="vcard">
				<p class="tel">+31 (0)20 7890 560</p>
				<p class="adr">
				<span class="street-address">Jan van Galenstraat 285-2</span><br>
				<span class="postal-code">1056CA</span><br>
				<span class="region">Amsterdam</span><br>
				<span class="country-name">the Netherlands</span>
			</p>
			</div>

			<br />
			<p class="email">Email ons: <a href="mailto:hallo@hunterandmiller.com" class="inline_link">hallo [at] hunterandmiller.com</a> voor het maken van een afspraak.</p>

    </div>
</div>

@stop