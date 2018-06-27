# RabbitMQ Workshop

## Zprovoznění
Pokud nechcete používat Nette aplikaci a chcete si pouze vyzkoušet webové rozhraní RabbitMQ a Supervisor s použitím přiloženého Docker kontejneru, můžete přeskočit na sekci [Docker](#docker) 

Pro korektní běh Nette aplikace je nutné v rootu projektu vytvořit složky `log` a `temp` a oběma složkám přidat oprávnění na čtení a zápis pro všechny uživatele. 

Dále je potřeba spustit v rootu projektu příkaz `composer install`.  

### Docker
Součástí projektu je i připravený Docker kontejner, který obsahuje jak RabbitMQ, tak i Supervisor.
 
Před spuštěním kontejneru je nutné zkopírovat soubor `docker-compose.EXAMPLE.override.yml` ve složce `docker/` a  pojmenovat ho `docker-compose.override.yml`. 
V tomto souboru lze definovat lokální nastavení Docker kontejneru, mimo jiné porty, na kterých jsou přístupné služby. 

Kontejner lze spustit ze složky `docker/` příkazem `docker-compose up`. 

## RabbitMQ Management 
Webové rozhraní pro RabbitMQ se v případě použití přiloženého Docker kontejneru a ponechání defaultních nastavení nachází na url <http://127.0.0.1:15672>. 

Přístupové údaje jsou `admin:admin`.

## Supervisor Management 
Webové rozhraní pro Supervisor se v případě použití přiloženého Docker kontejneru a ponechání defaultních nastavení nachází na url <http://127.0.0.1:9001>

Přístupové údaje jsou `admin:admin`. 

Pokud nechcete používat webové rozhraní, lze použít CLI rozhraní voláním služby `supervisorctl` (pro restartování všech služeb lze použít příkaz `supervisorctl restart all`). 

Konfigurační soubory pro Supervisor se nachází ve složce `docker/files/supervisor/`. 

## Spuštění producenta 
Před spuštěním producenta je nutné mít v RabbitMQ vytvořené fronty i exchange, jinak bude zpráva zahozena (viz. [přednáška](https://drive.google.com/open?id=1tvSNGAnABciV6oYtq_XWN_rZ5Dwd2hrm-wjFEy6Yq9w)). 

Definice front a exchange pro producenty a konzumenty se nachází v souboru `app/config/rabbitmq.neon`. 

Producenta lze spustit zadáním příkazu v rootu projektu ve tvaru 

`bin/console Rabbit:exampleProducer [message]`

, kde `[message]` je zpráva, kterou zasíláme do fronty. 

Pokud používáte Docker, je nutné se předtím připojit do kontejneru tímto příkazem: 

`docker exec -it rabbitmq_worshop bash`