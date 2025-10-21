 # 🎮 GamePortal - Laravel Gaming Community Platform

  Een dynamische gaming community website gebouwd met **Laravel 12**, geïntegreerd met de RAWG Video Games Database API. Dit platform biedt gebruikers de mogelijkheid om games te ontdekken,
  communities te creëren, nieuws te lezen en met elkaar te communiceren.

  ## 📋 Project Overzicht

  GamePortal is een full-stack Laravel applicatie ontwikkeld als eindproject voor het vak Backend Development. Het platform combineert real-time game data van de RAWG API met een volledig
  functioneel community systeem, nieuwsbeheer en gebruikersprofielen.

  ### Kernfunctionaliteiten
  - 🎮 **Game Database Integratie** - Realtime game data via RAWG API
  - 👥 **Community Systeem** - Gebruikers kunnen posts maken en discussiëren
  - 📰 **Nieuwsbeheer** - Admins kunnen gaming nieuws publiceren
  - ❓ **FAQ Systeem** - Georganiseerde vragen per categorie
  - 👤 **Gebruikersprofielen** - Aanpasbare profielen met foto's en favoriete games
  - 💬 **Comment Systeem** - Comments op games én community posts
  - ⭐ **Favorieten** - Gebruikers kunnen games favoriet maken
  - 🌓 **Dark/Light Theme** - Toggle tussen dark en light mode
  - ✉️ **Contact Formulier** - Direct contact met beheerders

  ## 🚀 Installatie Stappen

  ### Vereisten
  - PHP >= 8.2
  - Composer
  - MySQL/MariaDB database
  - Node.js & NPM (optioneel, voor assets)
  - RAWG API Key (gratis op https://rawg.io/apidocs)

  ### Stap voor Stap Installatie

  1. **Clone de repository**
     ```bash
     git clone MarwanMakouh/LaravelProject
     cd LaravelProject

  2. Installeer PHP dependencies
  composer install
  3. Kopieer environment configuratie
  cp .env.example .env
  4. Genereer applicatie key
  php artisan key:generate
  5. Configureer database
    - Maak een nieuwe MySQL database aan (bijv. gameportal)
    - Update .env bestand met je database credentials:
  DB_CONNECTION=mysql
  DB_HOST=127.0.0.1
  DB_PORT=3306
  DB_DATABASE=gameportal
  DB_USERNAME=root
  DB_PASSWORD=your_password
  6. Configureer RAWG API
    - Verkrijg een gratis API key op https://rawg.io/apidocs
    - Voeg toe aan .env:
  RAWG_API_KEY=your_rawg_api_key_here
  7. Configureer email (optioneel)
    - Voor contact formulier functionaliteit:
  MAIL_MAILER=smtp
  MAIL_HOST=smtp.gmail.com
  MAIL_PORT=587
  MAIL_USERNAME=your_email@gmail.com
  MAIL_PASSWORD=your_app_password
  MAIL_ENCRYPTION=tls
  MAIL_FROM_ADDRESS=your_email@gmail.com
  MAIL_FROM_NAME="${APP_NAME}"
  8. Voer database migrations en seeders uit
  php artisan migrate:fresh --seed
  8. Dit creëert alle tabellen en vult de database met basis testdata.
  9. Maak storage link aan
  php artisan storage:link
  9. Dit is nodig voor profielfoto's en nieuwsafbeeldingen.
  10. Start de development server
  php artisan serve
  10. De applicatie is nu bereikbaar op: http://localhost:8000

  👤 Standaard Login Credentials

  Admin Account

  - Email: admin@ehb.be
  - Wachtwoord: Password!321

  Test Gebruikers

  Alle test gebruikers hebben wachtwoord: password
  - john@example.com
  - sarah@example.com
  - mike@example.com
  - emma@example.com
  - alex@example.com

  🏗️ Project Structuur

  Models & Relationships

  - User - Gebruikers met admin rechten
    - hasOne(UserProfile)
    - hasMany(FavoriteGame)
    - belongsToMany(Game) - Many-to-many via favorite_games
  - Community - Community posts
    - belongsTo(User)
    - morphMany(Comment) - Polymorphic relatie
  - Game - Games uit RAWG API (lokaal gecached)
    - morphMany(Comment) - Polymorphic relatie
  - News - Nieuwsartikelen
  - Faq - Veelgestelde vragen met categorieën
  - Comment - Polymorphic model voor comments op Games en Communities

  Controllers

  - AuthController - Login, registratie, logout
  - HomeController - Homepage met game listings via RAWG API
  - ProfileController - Gebruikersprofielen (publiek + edit)
  - CommunityController - Community posts en comments
  - GamesController - Game details van RAWG API met comments
  - NewsController - Publieke nieuws weergave + admin CRUD
  - FaqController - Publieke FAQ + admin CRUD
  - ContactController - Contact formulier met email
  - Admin/UserController - Gebruikersbeheer voor admins
  - Admin/CommunityController - Community moderatie

  Middleware & Beveiliging

  - ✅ CSRF Protection op alle forms
  - ✅ XSS Protection via Blade escaping
  - ✅ Email verificatie vereist voor nieuwe accounts
  - ✅ Password hashing met bcrypt
  - ✅ Client-side validatie op formulieren
  - ✅ Server-side validatie in controllers
  - ✅ Route middleware voor authenticatie en admin rechten

  🎨 Features & Extra's

  Minimum Requirements (Volledig Geïmplementeerd)

  ✅ Login Systeem - Met admin/user rollen
  ✅ Profielpagina - Met username, verjaardag, foto, "over mij"
  ✅ Nieuws Systeem - CRUD voor admins, publiek zichtbaar
  ✅ FAQ Pagina - Gegroepeerd per categorie
  ✅ Contact Formulier - Met email naar admins

  Extra Features (Boven Minimum)

  🌟 RAWG API Integratie - Real-time game data
  🌟 Community Platform - Posts met comments systeem
  🌟 Polymorphic Comments - Herbruikbaar comment systeem
  🌟 Favoriete Games - Gebruikers kunnen games bookmarken
  🌟 Email Verificatie - Beveiligde account activatie
  🌟 Wachtwoord Reset - Forgot password functionaliteit
  🌟 Theme Toggle - Dark/Light mode met LocalStorage
  🌟 Infinite Scroll - Load more voor game listings
  🌟 Admin Dashboard - Centraal beheer van users, news, FAQ, communities
  🌟 Responsive Design - Werkt op alle schermformaten

  📚 Bronvermeldingen

  Externe APIs

  - RAWG Video Games Database API - https://rawg.io/apidocs
    - Gebruikt voor: Game data, screenshots, ratings, genres
    - Licentie: Gratis met attributie

  Framework & Libraries

  - Laravel Framework 12 - https://laravel.com
    - MIT License
  - Laravel Blade - Template engine
    - https://laravel.com/docs/12.x/blade

  Documentatie & Resources

  - Laravel Documentation - https://laravel.com/docs/12.x
  - Eloquent ORM - https://laravel.com/docs/12.x/eloquent
  - Laravel Mail - https://laravel.com/docs/12.x/mail
  - Laravel Storage - https://laravel.com/docs/12.x/filesystem
  - PHP Official Documentation - https://www.php.net/docs.php

  Design & Styling

  - Eigen CSS implementatie met dark/light theme
  - Geen externe CSS frameworks gebruikt

  🗄️ Database Schema

  Belangrijkste Tabellen

  - users - Gebruikers met admin flag
  - user_profiles - Extended user informatie (foto, about_me)
  - communities - Community posts
  - games - Lokale cache van RAWG games
  - comments - Polymorphic comments (voor games + communities)
  - favorite_games - Pivot tabel voor user-game many-to-many
  - news - Nieuwsartikelen
  - faqs - Veelgestelde vragen

  Relaties

  - One-to-One: User ↔ UserProfile
  - One-to-Many: User → FavoriteGame, Community → Comment
  - Many-to-Many: User ↔ Game (via favorite_games)
  - Polymorphic: Comment ↔ (Community | Game)

  🧪 Testing

  Om de applicatie te testen:

  1. Voer php artisan migrate:fresh --seed uit voor schone data
  2. Log in als admin (admin@ehb.be / Password!321)
  3. Test admin functionaliteiten:
    - Nieuws toevoegen/bewerken/verwijderen
    - FAQ beheren
    - Gebruikers beheren (admin rechten toekennen)
    - Community posts modereren
  4. Log in als reguliere gebruiker
  5. Test gebruikersfunctionaliteiten:
    - Profiel aanpassen met foto
    - Games favoriet maken
    - Community posts maken
    - Comments plaatsen

  📝 Belangrijke Opmerkingen

  - Profielfoto's worden opgeslagen in storage/app/public/profile_photos/
  - Nieuwsafbeeldingen worden opgeslagen in storage/app/public/news_images/
  - RAWG API heeft rate limiting (gratis tier: beperkt aantal requests)
  - Email verificatie is vereist voor nieuwe accounts
  - Admins kunnen zichzelf niet verwijderen (veiligheidsmaatregel)

  🤝 Auteur

  Marwan Makouh
  - GitHub: https://github.com/MarwanMakouh
  - Project: Backend Development Eindopdracht
  - School: Erasmushogeschool Brussel
