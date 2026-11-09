WONDERWORLD - PHP TOUR GUIDE WEBSITE

REQUIREMENTS
- XAMPP (Apache + MySQL)
- PHP 8+ recommended
- MySQL / phpMyAdmin
- Web browser

INSTALLATION
1. Extract the WonderWorld folder into: C:\xampp\htdocs\
2. Start Apache and MySQL from the XAMPP Control Panel.
3. Open http://localhost/phpmyadmin
4. Choose Import, select database.sql from this folder, and click Import.
   The SQL creates the wonderworld database and sample destinations, including map coordinates.
5. Check config.php. Default XAMPP settings are host=localhost, user=root,
   password blank. Change them if your MySQL settings differ.
6. Open http://localhost/WonderWorld/ in your browser.

ADMIN ACCESS
1. Register a normal account on the website.
2. In phpMyAdmin, open the wonderworld database and users table.
3. Find your account and change is_admin from 0 to 1.
4. Log out and log in again. The Admin link will appear.
5. Use the Admin Dashboard to add destinations.

UPGRADING AN EXISTING DATABASE
If you already imported an older WonderWorld database, do NOT re-import database.sql
over it. In phpMyAdmin select the wonderworld database, choose Import, and run
migration_add_destination_maps.sql once. This adds latitude/longitude columns and
fills coordinates for the six sample destinations. If you imported the updated
database.sql on a fresh install, do not run the migration too.

ADDING MAPS TO NEW DESTINATIONS
In Admin Dashboard, enter both latitude and longitude, or leave both blank.
Coordinates must be decimal degrees (latitude -90 to 90, longitude -180 to 180).
You can find a place's coordinates using a map service. The detail page then shows
an OpenStreetMap embed and a Google Maps directions link. Map tiles need internet.

FEATURES
- Responsive homepage and destination listing
- Search destinations by name, city or country
- Destination detail pages, travel tips, embedded maps and directions
- Registration, login and logout (passwords are hashed)
- Save/remove favourite destinations
- Contact form that stores messages in MySQL
- Admin dashboard to add destinations

NOTES
- This is a learning/demo project. Add CSRF protection, rate limiting,
  stricter validation, image upload controls and production security before
  deploying publicly.
- Sample destination photos load from Unsplash and need an internet connection.
