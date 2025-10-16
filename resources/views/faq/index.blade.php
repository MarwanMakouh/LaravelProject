@extends('layouts.app')

@section('title', 'FAQ - GamePortal')

@section('content')
<style>
    .faq-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 20px;
        box-sizing: border-box;
    }

    @media (max-width: 500px) {
        .faq-container {
            padding: 0 1rem;
        }
    }

    .faq-header {
        text-align: center;
        margin-bottom: 40px;
    }

    .faq-header h1 {
        font-size: 36px;
        font-weight: bold;
        margin-bottom: 10px;
        color: #ffffff;
    }

    body.light-theme .faq-header h1 {
        color: #000000;
    }

    .faq-header p {
        color: #cccccc;
    }

    body.light-theme .faq-header p {
        color: #666666;
    }

    .faq-item {
        background: #2a2a2a;
        border: 1px solid #444;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 20px;
        transition: all 0.3s ease;
    }

    body.light-theme .faq-item {
        background: #F9FAFB;
        border: 1px solid #000000;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .faq-item:hover {
        transform: translateY(-10px);
        border-color: #ffffff;
        box-shadow: 0 10px 30px rgba(255, 255, 255, 0.3);
    }

    body.light-theme .faq-item:hover {
        border-color: #000000;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    }

    .faq-question {
        font-size: 20px;
        font-weight: bold;
        color: #ffffff;
        margin-bottom: 10px;
    }

    body.light-theme .faq-question {
        color: #000000;
    }

    .faq-answer {
        font-size: 16px;
        line-height: 1.6;
        color: #cccccc;
    }

    body.light-theme .faq-answer {
        color: #333333;
    }
</style>

<div class="faq-container">
    <div class="faq-header">
        <h1>❓ Veelgestelde Vragen</h1>
        <p>Vind antwoorden op de meest gestelde vragen</p>
    </div>

    <div class="faq-item">
    <div class="faq-question">Hoe maak ik een account aan?</div>
    <div class="faq-answer">
        Klik rechtsboven op "Registreren" en vul het formulier in met je naam, e-mailadres en een wachtwoord. Na registratie ben je direct ingelogd!
    </div>
</div>

<div class="faq-item">
    <div class="faq-question">Zijn de games gratis?</div>
    <div class="faq-answer">
        Op GamePortal vind je informatie over zowel gratis als betaalde games. We geven duidelijk aan of een game gratis te spelen is of een aankoop vereist.
    </div>
</div>

<div class="faq-item">
    <div class="faq-question">Kan ik reviews plaatsen?</div>
    <div class="faq-answer">
        Ja! Als je bent ingelogd, kun je bij elke game pagina een reactie plaatsen en je mening delen over de game.
    </div>
</div>

<div class="faq-item">
    <div class="faq-question">Hoe verander ik tussen dark en light mode?</div>
    <div class="faq-answer">
        Klik op de thema-knop rechtsboven in de navigatiebalk (☀️/🌙) om te wisselen tussen dark en light mode. Je voorkeur wordt automatisch opgeslagen.
    </div>
</div>

<div class="faq-item">
    <div class="faq-question">Wordt de game informatie regelmatig bijgewerkt?</div>
    <div class="faq-answer">
        Ja, we werken onze game database regelmatig bij met de nieuwste releases en updates. Check de Community pagina voor de laatste nieuwtjes!
    </div>
</div>

<div class="faq-item">
    <div class="faq-question">Kan ik spelletjes direct vanaf deze site spelen?</div>
    <div class="faq-answer">
        GamePortal is een informatieplatform. We bieden informatie over games, maar de games zelf moeten via de officiële platforms worden gespeeld.
    </div>
</div>
</div>
@endsection
