[![Review Assignment Due Date](https://classroom.github.com/assets/deadline-readme-button-22041afd0340ce965d47ae6ef1cefeee28c7c493a6346c4f15d667ab976d596c.svg)](https://classroom.github.com/a/KjESaArp)
## Installatie stappen

1. Installeer XAMPP
2. Verander je login gegevens voor de database connectie in `config.php` 
3. Navigeer in je browser naar de het `install.php` script

```Voorbeeld: http://localhost/reacties/install.php```



# Reactiesysteem voor YouTube Video - PHP

## Beschrijving
Dit script stelt gebruikers in staat om te reageren op een video door hun naam, e-mail en bericht in te voeren. Reacties worden opgeslagen in een MySQL-database en weergegeven op dezelfde pagina. Het script behandelt ook sessies voor succes- en foutmeldingen van gebruikersfeedback.

## Voorwaarden
- Een MySQL-database (`youtube-clone` in het script) met tabellen `reactions` (id, video_id, name, email, message, date_added) en `videos` (id, title, url).
- PHP-versie 7.4 of hoger.
- Configureer de databaseverbinding in `config.php` met de juiste details (host, gebruiker, wachtwoord, dbnaam).

## Installatie
1. Cloneer of download het script.
2. Configureer je databaseverbinding in `config.php`:
   ```php
   <?php
   $dbhost = "localhost";
   $dbuser = "root";
   $dbpass = "wachtwoord";
   $dbname = "youtube-clone";
