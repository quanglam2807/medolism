Medolism
========

***I started this project when I was 14 years old without any frameworks or direct instructions. In 2014, I won the 2nd Prize in Creative Software - Vietnam's National Youth Computing Competition & the 1st Prize in Creative Software - Cantho's Provincial Youth Computing Competition by developing this app.***

***It was poorly coded, unmaintable so do not use it in production. I left it here on GitHub for archiving.***

***In 2017, I tried to reorganize the code and upgrade from PHP 5 to PHP 7. But it seemed like a worthless work.***

---

Medolism is a manga/comic sharing social network. It has many features, including an account system (to create, login, update profile, etc); publishing, reading & rating manga & many others. It supports multilingual UI but I use Vietnamese as the default language.

Medolism requires PHP 7.x, MySQL/MariaDB, and Apache with mod_rewrite. It must be served from a `/medolism` subdirectory (see `RewriteBase` in `.htaccess`).

Running it with Docker (2026)
-----------------------------

The old Homebrew `start.sh` no longer works, so the project now ships a Docker setup:

```sh
docker compose up --build
```

Then open <http://localhost:8080/medolism/>. The first start imports `sql/2012-07-06_09-34-00.sql` into MariaDB and repairs its double-encoded Vietnamese text (`docker/02-fix-encoding.sql`). The database persists in a named volume; run `docker compose down -v` to reset it and re-import.

`includes/config.php` reads `DB_HOST`, `DB_NAME`, `DB_USER`, `DB_PASS`, and `PAGE_URL` from the environment (set in `docker-compose.yml`) and falls back to the old hardcoded values, so a manual install still works:

  1. Copy all the sources to `<docroot>/medolism`.
  2. Import `sql/2012-07-06_09-34-00.sql` into a MySQL database, then run `docker/02-fix-encoding.sql` against it.
  3. Edit `includes/config.php` with your MySQL database information.

Known limitations of the archived code: `login.php` is a stub that logs everyone in as user 1 (admin); manga pages are hotlinked from image hosts that are mostly gone; the Bootstrap JS CDN and placehold.it links in the templates are dead; the SQL dump contains real 2012 user data; and every query is built with string interpolation. Do not expose this to the internet.
