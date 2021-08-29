compose_file := "docker-compose.yml"
php_service := "php"

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
	@docker-compose exec php php vendor/bin/php-cs-fixer fix tests

cache:
	@docker-compose exec php php bin/console cache:clear

tt:
	@docker-compose exec php php bin/phpunit

ttc:
	@docker-compose -f $(compose_file) exec $(php_service) sh -c "php bin/phpunit --coverage-html .coverage $(CMD)"
	@brave ".coverage/index.html"

migrate:
	@docker-compose exec php php bin/console doctrine:migrations:migrate
