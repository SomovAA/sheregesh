init: docker-init app-init
app-init: composer-install
docker-init: docker-clean docker-up
docker-restart: docker-down docker-up

docker-up:
	docker-compose up -d

docker-down:
	docker-compose down

docker-clean:
	docker-compose down --volume --remove-orphans

docker-build:
	docker-compose build


composer-install:
	docker-compose run --rm php-fpm composer install

migrate:
	docker-compose run --rm php-fpm php ./public/migrate.php