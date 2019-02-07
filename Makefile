.PHONY: up down stop prune ps shell drush logs

default: up

DRUPAL_ROOT ?= /var/www/html/docroot

up:
	@echo "Starting up containers for RCADigital..."
	docker-compose pull
	docker-compose up -d --remove-orphans

down: stop

stop:
	@echo "Stopping containers for RCADigital..."
	@docker-compose stop

prune:
	@echo "Removing containers for RCADigital..."
	@docker-compose down -v

ps:
	@docker ps --filter name='rcadigital*'

shell:
	docker exec -ti rcadigital_web_1 /bin/bash

drush:
	docker exec rcadigital_web_1 ../vendor/bin/drush -r $(DRUPAL_ROOT) $(filter-out $@,$(MAKECMDGOALS))

logs:
	@docker-compose logs -f $(filter-out $@,$(MAKECMDGOALS))
