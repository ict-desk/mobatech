# Mobatech Holland website

React + Vite statische website met:
- homepage in Mobatech huisstijl
- sticky/floating header
- contactdropdown met optie Vacatures
- aparte vacaturepagina via hash-route `/#vacatures`
- klikbare vacaturekaarten op homepage naar de juiste vacatureomschrijving
- eigen PHP contactformulier endpoint in `public/api/contact.php`

## Lokaal draaien

```bash
npm install
npm run dev
```

Open daarna de URL die Vite toont, meestal `http://localhost:5173/`.

## Productie-build maken

```bash
npm run build
```

Upload daarna alleen de inhoud van de map `dist/` naar de webroot van de server.

## Vacaturepagina

De vacaturepagina werkt via een hash-route:

```txt
/#vacatures
/#vacature-administrateur
/#vacature-allround-monteur
```

Voordeel: dit werkt ook op een simpele statische Linux hosting zonder extra Nginx rewrite-regels.

## Contactformulier

Het formulier post naar:

```txt
/api/contact.php
```

Dat bestand wordt automatisch meegebouwd naar:

```txt
dist/api/contact.php
```

Het formulier gebruikt PHP `mail()`. Als mailen mislukt, is SMTP via PHPMailer de volgende betrouwbaardere stap.
