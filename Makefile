up:
	@docker-compose up -d

down:
	@docker-compose down

build:
	@docker-compose build

upd:
	@docker-compose up -d --build

fix:
	@docker-compose exec php php vendor/bin/php-cs-fixer fix src
	@docker-compose exec php php vendor/bin/php-cs-fixer fix framework

cache:
	@docker-compose exec php php bin/console cache:clear
