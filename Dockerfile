# ============================================================
# Dockerfile – PHP Assignment
# Uses the official PHP + Apache image as the base.
# Copies our .php files into the web root so Apache serves
# them automatically.  mod_rewrite is enabled in case we
# ever need URL rewriting (good habit).
# ============================================================

# Start from the official PHP 8.2 image that already has
# Apache bundled in — no need to install a server manually.
FROM php:8.2-apache

# Enable mod_rewrite (optional but common best-practice)
RUN a2enmod rewrite

# Copy every file from our project root into the container's
# web-accessible directory (/var/www/html).
# The period (.) means "everything in the build context",
# i.e., everything in the GitHub repo root.
COPY . /var/www/html/

# Set the working directory so relative paths resolve here.
WORKDIR /var/www/html

# Apache listens on port 80 by default; tell Docker to
# expose that port so Render can route traffic to it.
EXPOSE 80

# Start Apache in the foreground (required by Docker —
# if the main process exits the container stops).
CMD ["apache2-ctl", "-D", "FOREGROUND"]
