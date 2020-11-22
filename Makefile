SHELL := /bin/bash
PROJECT_NAME=cars
CONTAINER_NAME=cars_fpm
USER_ID:=$(shell id -u)
GROUP_ID:=$(shell id -g)
COMPOSE=docker-compose -p "$(PROJECT_NAME)" -f dockers/docker-compose.yml


install:
	@make build
	@make up
	@docker exec -it $(CONTAINER_NAME) composer install

up:
	DOCKER_HOST_IP=${DOCKER_HOST_IP} $(COMPOSE) up -d

refresh: kill-all
	$(COMPOSE) build
	$(COMPOSE) up -d

test:
	@docker exec -it $(CONTAINER_NAME) vendor/bin/codecept run tests/
	@docker exec -it $(CONTAINER_NAME) vendor/bin/phpunit

bash:
	docker exec -it $(CONTAINER_NAME) bash

kill-all:
	echo "STOPPING CURRENT COMPOSE"
	$(COMPOSE) stop
	$(COMPOSE) rm -f || true
	echo "EVERYTHING STOPPED"

build:
	$(COMPOSE) build fpm
