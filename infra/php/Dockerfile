FROM php:8.4-fpm-bookworm

COPY --from=composer:2.8 /usr/bin/composer /usr/bin/composer

# 隣の php.ini を PHP の設定として読み込ませる（置くだけでは効きません）
COPY php.ini /usr/local/etc/php/conf.d/zzz-app.ini

RUN apt-get update && \
    apt-get -y install --no-install-recommends git unzip curl libzip-dev libicu-dev libonig-dev && \
    curl -fsSL https://deb.nodesource.com/setup_22.x | bash - && \
    apt-get install -y nodejs && \
    apt-get clean && rm -rf /var/lib/apt/lists/* && \
    docker-php-ext-install intl pdo_mysql zip bcmath

# ★ Aurora（RDS）の証明書の発行元（CA）の一覧。暗号化して Aurora につなぐとき、相手が本物かを確かめるのに使う
ADD --chmod=644 https://truststore.pki.rds.amazonaws.com/global/global-bundle.pem /etc/ssl/certs/rds-global-bundle.pem

RUN groupadd -g 1000 appuser && useradd -u 1000 -g appuser -m appuser
USER appuser
WORKDIR /data