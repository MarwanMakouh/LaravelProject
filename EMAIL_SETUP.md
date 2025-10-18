# 📧 Email Setup Guide - GamePortal

## Overzicht

GamePortal heeft nu email functionaliteit voor:
- ✅ **Email Verificatie** bij registratie
- ✅ **Wachtwoord Reset** functionaliteit

## Snelle Start (Gmail - Huidige Setup)

### Stap 1: Gmail App Password Aanmaken

**Je hebt al Gmail geconfigureerd!** Maar voor referentie, zo maak je een App Password:

1. Ga naar [Google Account Security](https://myaccount.google.com/security)
2. Zet **2-Factor Authentication** aan (als nog niet gedaan)
3. Ga naar **App Passwords** (onder 2-Step Verification)
4. Selecteer "Mail" en "Other" (Custom name: GamePortal)
5. Kopieer het 16-cijferige wachtwoord

### Stap 2: .env Configureren

✅ **Jouw huidige configuratie** (al ingesteld):

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=gameportaalproject@gmail.com
MAIL_PASSWORD=""
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="gameportaalproject@gmail.com"
MAIL_FROM_NAME="${APP_NAME}"

APP_URL=http://127.0.0.1:8000
```

**BELANGRIJK**:
- ✅ Gmail is geconfigureerd en klaar voor gebruik
- ⚠️ Gmail heeft een limiet van ~500 emails per dag
- 🔒 Deel het App Password nooit publiekelijk

### Stap 3: Cache Wissen

```bash
php artisan config:clear
php artisan cache:clear
```

### Stap 4: Testen

1. Registreer een nieuw account op http://127.0.0.1:8000/register
2. Check je **gameportaalproject@gmail.com** inbox voor de verificatie email
3. Test "Wachtwoord vergeten" functionaliteit op de login pagina

**Tip**: Check ook je SPAM folder als je geen email ontvangt!

## Alternatieve Opties

### Mailtrap (Voor Testing/Development)

Als je geen echte emails wilt versturen tijdens development:

⚠️ **Voordeel**: Vangt alle emails op, stuurt ze niet echt
✅ **Gratis**: 100% gratis voor development

**Setup:**
1. Registreer op [mailtrap.io](https://mailtrap.io)
2. Maak een inbox aan
3. Kopieer credentials naar .env:

```env
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_mailtrap_username
MAIL_PASSWORD=your_mailtrap_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@gameportal.com"
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
