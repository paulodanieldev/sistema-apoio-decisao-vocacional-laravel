.PHONY: up
up:
	docker-compose up -d

.PHONY: build
build:
	docker-compose up -d --build

.PHONY: install
install:
	./install.sh

.PHONY: down
down:
	docker-compose down

.PHONY: test
test:
	docker-compose exec app php artisan test

.PHONY: clean
clean:
	docker-compose exec app php artisan clean

.PHONY: bash
bash:
	docker-compose exec app bash

.PHONY: migrate
migrate:
	docker-compose exec app php artisan migrate

.PHONY: rollback
rollback:
	docker-compose exec app php artisan migrate:rollback

.PHONY: seed
seed:
	docker-compose exec app php artisan db:seed
