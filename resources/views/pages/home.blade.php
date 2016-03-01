@extends('layouts.master')

@section('content')



<main>

    <div class="row">
        <div class="column">
        	<h1 class="home">Hunter <span class="ampersand">&#038;</span> Miller</h1>

        	<div class="logo_cont">
        		<img src="img/vogel.svg" class"logo" alt="vogel" />
        	</div>

        	<div class="part_container">
            	<div class="part">
            		<!-- Particles -->
            		<div><p><b></b></p></div>
            		<div><p><b></b></p></div>
            		<div><p><b></b></p></div>
            		<div><p><b></b></p></div>
            		<div><p><b></b></p></div>
            		<div><p><b></b></p></div>
            		<div><p><b></b></p></div>
            		<div><p><b></b></p></div>
            		<div><p><b></b></p></div>
            	</div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="column">
            <h2 class="tagline text-center">Wij zijn een grafisch en digitaal ontwerp bureau.</h2>
            <h5 class="subheader">Wij maken websites, huisstijlen en identiteiten voor klanten die hun visie helder naar buiten toe willen dragen.</h5>

            <p class="text-justify">Wij zijn een bedrijf met een eenvoudige doel &#8211; om de kracht en visie van elk bedrijf waar we mee samen werken zo sterk mogelijk naar buiten toe te brengen. Wij combineren engagerende ontwerpen met de nieuwste technieken om te zorgen dat elk van onze projecten een memorabele indruk achter laat.</p>

            <a href="{{ URL::route('portfolio') }}" class="button"><h3>bekijk ons werk</h3></a>
        </div>
    </div>


@stop