up:
	docker-compose -f Docker/docker-compose.yml up -d
composer-install:
	docker-compose -f Docker/docker-compose.yml run --rm --user=1000 api composer install --prefer-dist

