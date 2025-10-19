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

    .faq-category {
        margin-bottom: 40px;
    }

    .faq-category-title {
        font-size: 28px;
        font-weight: bold;
        color: #6366f1;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid #6366f1;
    }

    body.light-theme .faq-category-title {
        color: #000000;
        border-bottom-color: #000000;
    }

    .no-faqs {
        text-align: center;
        padding: 40px 20px;
        color: #999;
        font-style: italic;
    }

    body.light-theme .no-faqs {
        color: #666;
    }
</style>

<div class="faq-container">
    <div class="faq-header">
        <h1>❓ Veelgestelde Vragen</h1>
        <p>Vind antwoorden op de meest gestelde vragen</p>
    </div>

    @if($faqsByCategory->isEmpty())
        <div class="no-faqs">
            Er zijn momenteel geen FAQ's beschikbaar.
        </div>
    @else
        @foreach($faqsByCategory as $category => $faqs)
            <div class="faq-category">
                <h2 class="faq-category-title">{{ $category }}</h2>

                @foreach($faqs as $faq)
                    <div class="faq-item">
                        <div class="faq-question">{{ $faq->question }}</div>
                        <div class="faq-answer">{{ $faq->answer }}</div>
                    </div>
                @endforeach
            </div>
        @endforeach
    @endif
</div>
@endsection
