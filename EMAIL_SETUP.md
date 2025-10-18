# 📧 Email Setup Guide - GamePortal

## Overzicht

GamePortal heeft nu email functionaliteit voor:
- ✅ **Email Verificatie** bij registratie
- ✅ **Wachtwoord Reset** functionaliteit

## Snelle Start (Development)

### Stap 1: Email Provider Kiezen

Voor **development/testing** raden we **Mailtrap** aan (100% gratis):

1. Ga naar [mailtrap.io](https://mailtrap.io) en maak een account
2. Maak een nieuwe inbox aan
3. Kopieer de SMTP credentials

### Stap 2: .env Configureren

Open je `.env` bestand en voeg toe:

```env
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_mailtrap_username
MAIL_PASSWORD=your_mailtrap_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@gameportal.com"
MAIL_FROM_NAME="GamePortal"

APP_URL=http://127.0.0.1:8000
```

**BELANGRIJK**: Zorg dat `APP_URL` correct is ingesteld!

### Stap 3: Cache Wissen

```bash
php artisan config:clear
php artisan cache:clear
```

### Stap 4: Testen

1. Registreer een nieuw account
2. Check je Mailtrap inbox voor de verificatie email
3. Test "Wachtwoord vergeten" functionaliteit

## Productie Opties

### Gmail (Eenvoudig maar beperkt)

⚠️ **Let op**: Gmail heeft een limiet van ~500 emails per dag

**Setup:**
1. Zet 2-Factor Authentication aan in je Google Account
2. Ga naar: Google Account → Security → App Passwords
3. Genereer een nieuw App Password voor "Mail"
4. Gebruik dit wachtwoord in je .env:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-16-digit-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="your-email@gmail.com"
MAIL_FROM_NAME="GamePortal"
```

### SendGrid (Aanbevolen voor Productie)

✅ **Gratis**: 100 emails/dag gratis
✅ **Professioneel**: Goede deliverability
✅ **Schaalbaar**: Eenvoudig upgraden

**Setup:**
1. Registreer op [sendgrid.com](https://sendgrid.com)
2. Verifieer je sender identity
3. Genereer een API key
4. Configureer .env:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.sendgrid.net
MAIL_PORT=587
MAIL_USERNAME=apikey
MAIL_PASSWORD=your_sendgrid_api_key
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@gameportal.com"
MAIL_FROM_NAME="GamePortal"
```

## Beschikbare Routes

### Email Verificatie
- `GET /email/verify` - Verificatie notice pagina
- `GET /email/verify/{id}/{hash}` - Verificatie link (signed)
- `POST /email/verification-notification` - Verstuur opnieuw

### Wachtwoord Reset
- `GET /forgot-password` - Wachtwoord vergeten formulier
- `POST /forgot-password` - Verstuur reset link
- `GET /reset-password/{token}` - Reset formulier
- `POST /reset-password` - Verwerk reset

## Testen zonder Email

Voor snelle testing kun je email uitschakelen:

```env
MAIL_MAILER=log
```

Emails worden nu naar `storage/logs/laravel.log` geschreven.

## Troubleshooting

### "Connection refused"
- Check of MAIL_HOST en MAIL_PORT correct zijn
- Controleer firewall instellingen

### "Authentication failed"
- Voor Gmail: Gebruik App Password, niet je normale wachtwoord
- Voor Mailtrap: Kopieer credentials exact zoals getoond

### Emails komen niet aan
- Check SPAM folder
- Verifieer MAIL_FROM_ADDRESS
- Voor Gmail: Check "Less secure apps" niet nodig met App Password

### Links in emails werken niet
- Zorg dat APP_URL correct is in .env
- Run `php artisan config:clear` na wijzigingen

## Database

De `email_verified_at` kolom in de `users` tabel wordt automatisch gezet wanneer een gebruiker zijn email verifieert.

## Aanpassingen

### Email Templates Customizen

Laravel gebruikt Markdown templates. Publiceer ze met:

```bash
php artisan vendor:publish --tag=laravel-mail
```

Templates staan dan in `resources/views/vendor/mail/`

### Verificatie Email Aanpassen

Maak een notification in `app/Notifications/`:

```bash
php artisan make:notification CustomVerifyEmail
```

## Veiligheid

✅ Emails zijn signed (verification links)
✅ Rate limiting op resend (max 6 per minuut)
✅ Password reset tokens expiren na 60 minuten
✅ CSRF bescherming op alle forms

## Support

Bekijk ook:
- [Laravel Mail Documentation](https://laravel.com/docs/mail)
- [Laravel Email Verification](https://laravel.com/docs/verification)
- [Laravel Password Reset](https://laravel.com/docs/passwords)
