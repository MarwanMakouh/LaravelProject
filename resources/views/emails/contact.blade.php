<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Bericht - GamePortal</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .email-header {
            background: #000000;
            color: #ffffff;
            padding: 30px;
            text-align: center;
        }
        .email-header h1 {
            margin: 0;
            font-size: 24px;
        }
        .email-body {
            padding: 30px;
        }
        .info-box {
            background: #f9f9f9;
            border-left: 4px solid #6366f1;
            padding: 15px;
            margin: 20px 0;
        }
        .info-box strong {
            display: block;
            color: #6366f1;
            margin-bottom: 5px;
        }
        .message-box {
            background: #f9f9f9;
            padding: 20px;
            border-radius: 5px;
            margin: 20px 0;
        }
        .email-footer {
            background: #f4f4f4;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>🎮 GamePortal</h1>
            <p>Nieuw Contact Bericht</p>
        </div>

        <div class="email-body">
            <h2>Nieuw bericht ontvangen</h2>
            <p>Je hebt een nieuw bericht ontvangen via het contact formulier op GamePortal.</p>

            <div class="info-box">
                <strong>Van:</strong>
                {{ $contactName }}
            </div>

            <div class="info-box">
                <strong>Email:</strong>
                <a href="mailto:{{ $contactEmail }}">{{ $contactEmail }}</a>
            </div>

            <div class="info-box">
                <strong>Onderwerp:</strong>
                {{ $contactSubject }}
            </div>

            <div class="message-box">
                <strong style="display: block; margin-bottom: 10px; color: #333;">Bericht:</strong>
                {{ $contactMessage }}
            </div>

            <p style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #ddd; color: #666; font-size: 14px;">
                💡 <strong>Tip:</strong> Je kunt direct antwoorden door op "Reply" te klikken. Het antwoord wordt automatisch naar {{ $contactEmail }} gestuurd.
            </p>
        </div>

        <div class="email-footer">
            <p>Deze email is automatisch gegenereerd door GamePortal</p>
            <p>&copy; {{ date('Y') }} GamePortal. Alle rechten voorbehouden.</p>
        </div>
    </div>
</body>
</html>
