FROM php:8.2-apache

RUN a2enmod rewrite
COPY . /var/www/html/
RUN chown -R www-data:www-data /var/www/html

CMD ["apache2-foreground"]
EXPOSE 80
# Redeploy for Render fix
# force change for render deploy
