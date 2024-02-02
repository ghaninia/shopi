include .env

composer-install:
	@docker-compose -f docker-compose.yml run --rm web \
 		composer update --no-scripts

liquibase-migrate:
	@docker-compose -f docker-compose.yml run --rm liquibase \
		--url=jdbc:mysql://${DB_ADDRESS}/${DB_NAME} \
		--changeLogFile=dbchangelog.yaml \
		--username=${DB_USERNAME} \
		--password=${DB_PASSWORD} \
		--log-level=debug update

test:
	@docker-compose -f docker-compose.yml run --rm web \
		vendor/bin/phpunit --coverage-html coverage
