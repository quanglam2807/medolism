FROM php:7.4-apache

# mysqli for the DB layer; mod_rewrite for the extensionless URLs in .htaccess
RUN docker-php-ext-install mysqli && a2enmod rewrite

# Let .htaccess take effect, and send / to the /medolism/ mount point that
# RewriteBase and $page_url expect.
RUN sed -i 's#AllowOverride None#AllowOverride All#' /etc/apache2/apache2.conf \
 && echo 'RedirectMatch ^/$ /medolism/' > /etc/apache2/conf-enabled/medolism-root.conf

# Production ini: errors go to the container log (docker compose logs web), not the page.
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

WORKDIR /var/www/html/medolism
COPY . .

# uploads/ is gitignored; create it at start so add/edit manga can write cover images.
CMD ["sh", "-c", "mkdir -p uploads/bigimg uploads/smallimg && chown -R www-data:www-data uploads && exec apache2-foreground"]
