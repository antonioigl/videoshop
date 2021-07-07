#!/bin/bash
DOCKER_APP = app-videoshop
DOCKER_DB = app-db-videoshop
UID = $(shell id -u)

help: ## Show this help message
	@echo 'usage: make [target]'
	@echo
	@echo 'targets:'
	@egrep '^(.+)\:\ ##\ (.+)' ${MAKEFILE_LIST} | column -t -c 2 -s ':#'

run: ## Start the containers
	U_ID=${UID} docker-compose up -d
	U_ID=${UID} docker exec -it ${DOCKER_APP} php vendor/bin/phpunit

stop: ## Stop the containers
	U_ID=${UID} docker exec -it ${DOCKER_APP} php vendor/bin/phpunit
	U_ID=${UID} docker-compose down

restart: ## Restart the containers
	U_ID=${UID} docker-compose down && U_ID=${UID} docker-compose up -d

build: ## Rebuilds all the containers
	U_ID=${UID} docker-compose build

ssh-app: ## ssh's into the be container
	U_ID=${UID} docker exec -it ${DOCKER_APP} bash

log-app: ## log app
	U_ID=${UID} docker-compose logs -f -t ${DOCKER_APP}

ssh-db: ## ssh's into the be container
	U_ID=${UID} docker exec -it ${DOCKER_DB} bash

log-db: ## log app
	U_ID=${UID} docker-compose logs -f -t ${DOCKER_DB}

test: ## execute test
	U_ID=${UID} docker exec -it ${DOCKER_APP} php vendor/bin/phpunit

ps: ## view docker processes
	U_ID=${UID} docker ps

services: ## debug:autowiring
	U_ID=${UID} docker exec -it ${DOCKER_APP} bin/console debug:autowiring

fixture: ## fixtures
	U_ID=${UID} docker exec -it ${DOCKER_APP} bin/console doctrine:fixtures:load --append

project-init-app: ## init app
	U_ID=${UID} docker-compose up -d && docker exec -it ${DOCKER_APP} composer install

project-init-db:  ## init data base
	U_ID=${UID} docker exec -it ${DOCKER_APP} bin/console doctrine:schema:create
	U_ID=${UID} docker exec -it ${DOCKER_APP} bin/console doctrine:fixtures:load --append

entity: ## make entity
	U_ID=${UID} docker exec -it ${DOCKER_APP} php bin/console make:entity

schema: ## create schema
	U_ID=${UID} docker exec -it ${DOCKER_APP} bin/console doctrine:schema:create

.PHONY: run stop restart build ssh-app log-app ps composer-install test services project-init fixture project-init-db
