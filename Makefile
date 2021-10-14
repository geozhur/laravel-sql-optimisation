
server:
	php artisan serv

clear:
	php artisan optimize:clear

setup: env-prepare sqlite-prepare install key db-prepare ide-helper
	npm run dev

install-app:
	composer install

install-frontend:
	npm ci

install: install-app install-frontend

db-prepare:
	php artisan migrate:fresh --seed

env-prepare:
	cp -n .env.example .env || true

sqlite-prepare:
	touch database/database.sqlite

key:
	php artisan key:generate

test:
	php artisan test

ide-helper:
	php artisan ide-helper:eloquent
	php artisan ide-helper:gen
	php artisan ide-helper:meta
	php artisan ide-helper:mod -n

.PHONY: test
