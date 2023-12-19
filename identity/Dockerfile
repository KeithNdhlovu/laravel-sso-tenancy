FROM docker.io/bitnami/laravel:10

#
#--------------------------------------------------------------------------
# Init
#--------------------------------------------------------------------------
#

COPY . /app
WORKDIR /app

RUN composer install --no-interaction
RUN npm ci
RUN npm run build