# Profiel Functionaliteit Setup

## Overzicht
Ik heb een complete profiel functionaliteit toegevoegd aan je Laravel applicatie. Gebruikers kunnen nu:
- Een profiel foto uploaden
- Een "over mij" tekst toevoegen
- Hun publieke profiel bekijken
- Op andere gebruikersprofielen klikken via comments

## Wat is er toegevoegd?

### Database
- **Migratie**: `database/migrations/2025_01_18_000000_create_user_profiles_table.php`
  - Bevat tabel voor profiel foto's en "over mij" tekst
  - Gekoppeld aan users via foreign key

### Models
- **UserProfile**: `app/Models/UserProfile.php`
  - Relatie met User model
  - Helper voor profiel foto URL
- **User model**: Uitgebreid met `profile()` relatie

### Controllers
- **ProfileController**: `app/Http/Controllers/ProfileController.php`
  - `show($id)` - Publieke profiel weergave
  - `edit()` - Profiel bewerken (eigen profiel)
  - `update()` - Profiel opslaan
  - `deletePhoto()` - Profiel foto verwijderen

### Routes
```php
// Publiek toegankelijk profiel
GET /profile/{id}

// Alleen voor ingelogde gebruikers (eigen profiel)
GET /profile/edit/me
POST /profile/update
DELETE /profile/photo
```

### Views
- **profile/show.blade.php** - Publieke profiel pagina
- **profile/edit.blade.php** - Profiel bewerken pagina

### Comment Updates
- Community en Games comment secties tonen nu klikbare links naar gebruikersprofielen
- Alleen voor comments van ingelogde gebruikers (gastcomments hebben geen link)

## Installatie Stappen

### 1. Database Migratie Uitvoeren
```bash
php artisan migrate
```

Dit maakt de `user_profiles` tabel aan in je database.

### 2. Storage Link Maken
Laravel slaat geüploade bestanden op in `storage/app/public`. Om deze toegankelijk te maken via de browser, moet je een symbolic link maken:

```bash
php artisan storage:link
```

Dit maakt een symbolic link van `public/storage` naar `storage/app/public`.

### 3. Default Avatar Toevoegen (Optioneel)
Plaats een standaard avatar afbeelding in:
```
public/images/default-avatar.png
```

Als deze niet bestaat, kun je een placeholder gebruiken. Download een gratis avatar van:
- https://www.flaticon.com/free-icons/user
- https://www.freepik.com/free-photos-vectors/avatar

Of maak de directory en plaats er een placeholder:
```bash
mkdir public/images
# Plaats hier je default-avatar.png
```

### 4. Storage Permissions (Indien nodig)
Zorg ervoor dat de storage directory schrijfrechten heeft:

**Linux/Mac:**
```bash
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

**Windows:**
Meestal geen actie nodig, maar zorg dat de webserver schrijfrechten heeft op de `storage` directory.

## Gebruik

### Als Gebruiker:
1. Log in op je account
2. Ga naar `/profile/edit/me` om je profiel te bewerken
3. Upload een profiel foto (max 2MB, JPG/PNG/GIF)
4. Voeg een "over mij" tekst toe (max 1000 karakters)
5. Klik op "Profiel Opslaan"

### Profiel Bekijken:
- Je eigen profiel: `/profile/{jouw-user-id}`
- Andermans profiel: Klik op hun naam in een comment

### Profiel Links in Comments:
- Comments van ingelogde gebruikers hebben een klikbare naam
- Klik op de naam om naar het profiel te gaan
- Gastcomments (zonder account) hebben geen klikbare link

## Technische Details

### Bestandsopslag
- Profiel foto's worden opgeslagen in: `storage/app/public/profile-photos/`
- Toegankelijk via: `/storage/profile-photos/bestandsnaam.jpg`

### Validatie
**Profiel Foto:**
- Max grootte: 2MB
- Toegestane types: jpeg, png, jpg, gif

**Over Mij:**
- Max lengte: 1000 karakters
- Optioneel veld

### Security
- Alleen ingelogde gebruikers kunnen hun eigen profiel bewerken
- Profile edit pagina is beveiligd met `auth` middleware
- Profielen bekijken is publiek toegankelijk

## Troubleshooting

### "File not found" bij profiel foto's
**Probleem:** Geüploade foto's worden niet weergegeven.

**Oplossing:**
1. Controleer of symbolic link bestaat: `ls -la public/storage` (Linux/Mac) of check `public\storage` directory (Windows)
2. Voer opnieuw uit: `php artisan storage:link`
3. Check storage permissions

### Default avatar wordt niet weergegeven
**Probleem:** Standaard avatar ontbreekt.

**Oplossing:**
1. Maak directory: `mkdir public/images`
2. Plaats een `default-avatar.png` bestand in `public/images/`
3. Alternatief: Pas het pad aan in `UserProfile.php` en `profile/edit.blade.php`

### Foto upload werkt niet
**Probleem:** Foto's kunnen niet worden geüpload.

**Oplossing:**
1. Check `php.ini` settings:
   - `upload_max_filesize = 2M` (of hoger)
   - `post_max_size = 8M` (of hoger)
2. Check storage permissions
3. Check disk space op server

## Database Schema

```sql
CREATE TABLE user_profiles (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    user_id BIGINT NOT NULL,
    profile_photo VARCHAR(255) NULL,
    about_me TEXT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
```

## Volgende Stappen / Uitbreidingen

Mogelijke uitbreidingen die je kunt toevoegen:
- [ ] Cover foto toevoegen
- [ ] Social media links
- [ ] Privé profielen (zichtbaarheid instelling)
- [ ] Profiel volgen / vrienden systeem
- [ ] Profiel statistieken (aantal posts, comments, etc.)
- [ ] Profiel badges / achievements
- [ ] Bio met markdown ondersteuning
- [ ] Locatie en tijdzone

## Support

Als je problemen ondervindt:
1. Check Laravel logs: `storage/logs/laravel.log`
2. Check browser console voor JavaScript errors
3. Test met `php artisan route:list` of routes correct zijn
4. Verifieer database verbinding
