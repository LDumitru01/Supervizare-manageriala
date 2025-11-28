# Ghid de Setup pentru Admin Panel

## Pasul 1: Execută Setup-ul Bazei de Date în phpMyAdmin

### Metoda 1: Copiază și Execută SQL-ul

1. **Deschide phpMyAdmin**
   - Accesează `http://localhost/phpmyadmin` în browser
   - Selectează baza de date `supervizare_manageriala` (sau `integrae_contact_form` pentru hosting)

2. **Copiază conținutul SQL**
   - Deschide fișierul `admin/setup-database.sql`
   - Copiază tot conținutul SQL

3. **Execută SQL-ul**
   - În phpMyAdmin, mergi la fila **"SQL"**
   - Lipește conținutul SQL copiat
   - Apasă butonul **"Execută"**

### Metoda 2: Importă Fișierul SQL

1. **În phpMyAdmin**
   - Selectează baza de date corectă
   - Mergi la fila **"Import"**
   - Apasă butonul **"Choose File"**
   - Navighează la `admin/setup-database.sql`
   - Apasă **"Execută"**

## Pasul 2: Verifică Tabelele Create

După executarea SQL-ului, verifică că au fost create următoarele tabele:

- `admin_users` - pentru utilizatorii admin
- `blog_posts` - pentru articolele de blog (ar trebui să existe deja)

## Pasul 3: Accesează Admin Panel-ul

1. **Deschide browser-ul** și accesează:
   ```
   http://localhost/supervizare-manageriala/admin/login.php
   ```

2. **Login cu contul default**:
   - **Utilizator**: `admin`
   - **Parolă**: `admin123`

## Pasul 4: Schimbă Parola Default

**IMPORTANT**: După primul login, schimbă parola default:

1. Mergi la **"Gestionează Utilizatori"** în admin panel
2. Caută utilizatorul `admin`
3. Actualizează parola cu una sigură

## Verificare Setup

Dacă setup-ul a funcționat corect, ar trebui să poți:

- ✅ Te loghezi în admin panel
- ✅ Vezi dashboard-ul cu statistici
- ✅ Adaugi articole noi pe blog
- ✅ Gestionezi utilizatorii

## Depanare

### Dacă primești erori:

**Eroare: "Tabela admin_users nu există"**
- Verifică că ai executat SQL-ul corect în phpMyAdmin
- Asigură-te că ești conectat la baza de date corectă

**Eroare de conexiune la baza de date**
- Verifică fișierul `config/database.php` că are datele corecte
- Asigură-te că serverul MySQL rulează

**Eroare de permisiuni**
- Verifică că directorul `uploads/blog/` are permisiuni de scriere (755 sau 775)

## Structura Bazei de Date Create

Fișierul `setup-database.sql` va crea:

1. **Tabela `admin_users`**:
   - Utilizatori pentru admin panel
   - Roluri: `admin` (acces complet) și `editor` (doar blog)

2. **Utilizator default**:
   - username: `admin`
   - password: `admin123` (hash-uit securizat)
   - role: `admin`

3. **Actualizări la tabela `blog_posts`**:
   - Adaugă coloana `author_id` pentru a ține evidența autorului