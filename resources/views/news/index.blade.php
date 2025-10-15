@extends('layouts.app')

@section('title', 'Community - GamePortal')

@section('content')
<style>
    .community-header {
        text-align: center;
        margin-bottom: 40px;
    }

    .community-header h1 {
        font-size: 36px;
        font-weight: bold;
        margin-bottom: 10px;
        color: #ffffff;
    }

    body.light-theme .community-header h1 {
        color: #000000;
    }

    .community-header p {
        color: #cccccc;
    }

    body.light-theme .community-header p {
        color: #666666;
    }

    .post-card {
        background: #2a2a2a;
        border: 1px solid #444;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 20px;
        transition: all 0.3s ease;
    }

    body.light-theme .post-card {
        background: #F9FAFB;
        border: 1px solid #000000;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .post-card:hover {
        transform: translateY(-10px);
        border-color: #ffffff;
        box-shadow: 0 10px 30px rgba(255, 255, 255, 0.3);
    }

    body.light-theme .post-card:hover {
        border-color: #000000;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    }

    .post-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }

    .post-author {
        font-weight: bold;
        font-size: 18px;
        color: #6366f1;
    }

    body.light-theme .post-author {
        color: #000000;
    }

    .post-date {
        font-size: 14px;
        color: #999;
    }

    body.light-theme .post-date {
        color: #666;
    }

    .post-content {
        font-size: 16px;
        line-height: 1.6;
        color: #ffffff;
    }

    .post-content h3 {
        color: #ffffff;
    }

    body.light-theme .post-content {
        color: #333333;
    }

    body.light-theme .post-content h3 {
        color: #000000;
    }

    .post-footer {
        margin-top: 15px;
        padding-top: 15px;
        border-top: 1px solid #333;
        display: flex;
        gap: 20px;
    }

    body.light-theme .post-footer {
        border-top: 1px solid #ddd;
    }

    .post-action {
        color: #999;
        font-size: 14px;
        cursor: pointer;
        transition: color 0.3s;
    }

    .post-action:hover {
        color: #6366f1;
    }

    body.light-theme .post-action:hover {
        color: #000000;
    }
</style>

<div class="community-header">
    <h1>💬 Community</h1>
    <p>Deel je gaming ervaringen en praat met andere gamers</p>
</div>

<div class="post-card">
    <div class="post-header">
        <span class="post-author">👤 GameMaster2024</span>
        <span class="post-date">2 uur geleden</span>
    </div>
    <div class="post-content">
        <h3>Welkom in de GamePortal Community!</h3>
        <p>Hé gamers! Dit is de plek om je favoriete games te bespreken, tips te delen en nieuwe gaming vrienden te maken. Wat speel jij momenteel?</p>
    </div>
    <div class="post-footer">
        <span class="post-action">👍 24 Likes</span>
        <span class="post-action">💬 12 Reacties</span>
    </div>
</div>

<div class="post-card">
    <div class="post-header">
        <span class="post-author">👤 ProGamer99</span>
        <span class="post-date">5 uur geleden</span>
    </div>
    <div class="post-content">
        <h3>Beste multiplayer games van 2024?</h3>
        <p>Ik ben op zoek naar nieuwe multiplayer games om met vrienden te spelen. Wat zijn jullie aanbevelingen?</p>
    </div>
    <div class="post-footer">
        <span class="post-action">👍 18 Likes</span>
        <span class="post-action">💬 32 Reacties</span>
    </div>
</div>

<div class="post-card">
    <div class="post-header">
        <span class="post-author">👤 CasualGamer</span>
        <span class="post-date">1 dag geleden</span>
    </div>
    <div class="post-content">
        <h3>Gaming setup tips</h3>
        <p>Zojuist mijn gaming setup ge-upgrade! Deel hier je setup en laten we elkaar inspireren 🎮✨</p>
    </div>
    <div class="post-footer">
        <span class="post-action">👍 45 Likes</span>
        <span class="post-action">💬 28 Reacties</span>
    </div>
</div>
@endsection
