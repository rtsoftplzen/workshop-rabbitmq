#!/usr/bin/env bash
# Soubor příkazů, které se provedou v docker konteineru ihned po spuštění nebo sestavení image

# Spusteni a nastaveni RabbitMQ
service rabbitmq-server start
rabbitmqctl add_user admin admin
rabbitmqctl set_user_tags admin administrator
rabbitmqctl set_permissions -p / admin ".*" ".*" ".*"
echo "Dokončeno nastavování RabbitMQ"

# Spusteni Supervisord
service supervisor start
echo "Spuštěn supervisord"

# Spuštění Apache
apache2ctl -D FOREGROUND
