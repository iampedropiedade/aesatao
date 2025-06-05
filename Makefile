build:
	docker compose build

start:
	docker compose up -d

stop:
	docker stop aesatao_app
	docker stop aesatao_db

stop-app:
	docker stop aesatao_app

fix:
	docker run --entrypoint "" --rm -it -v $(CURDIR)/public:/var/www/html -v $(CURDIR)/phpcs.xml:/var/www/html/phpcs.xml php:8.2-apache bash -c "cd /var/www/html && php vendor/bin/phpcbf"

stan:
	docker run --entrypoint "" --rm -it -v $(CURDIR)/phpstan.neon:/var/www/html/phpstan.neon -v $(CURDIR)/app:/var/www/html php:8.2-apache bash -c "cd /var/www/html && php vendor/bin/phpstan analyse"

phpcs:
	docker run --entrypoint "" --rm -it -v $(CURDIR)/phpcs.xml:/var/www/html/phpcs.xml -v $(CURDIR)/app:/var/www/html php:8.2-apache bash -c "cd /var/www/html && php vendor/bin/phpcs"

bash:
	docker exec -it aesatao_app bash

bash-db:
	docker exec -it aesatao_db bash

open:
	open http://localhost:8142/

configure-nginx:
	cp /home/aeaav/nginx/default /etc/nginx/sites-available/default && sudo systemctl reload nginx

compile-ui:
	docker run --rm -it -v $(CURDIR):/src/ node:22 bash -c "cd /src/ui && yarn install && yarn production"

composer:
	docker exec -it --user www-data aesatao_app sh -c "cd /var/www/html && composer install"

doctrine:
	docker exec -it --user www-data aesatao_app sh -c "/var/www/html/concrete/bin/concrete5 orm:generate:proxies"

clear-cache:
	docker exec -it --user www-data aesatao_app sh -c "/var/www/html/concrete/bin/concrete5 c5:clear-cache"

git-pull:
	eval $(ssh-agent -s) && ssh-add ~/.ssh/id_rsa_aesatao && git pull

permissions-files:
	docker exec -it aesatao_app sh -c "mkdir -p /var/www/html/application/files && chown -Rv www-data:www-data /var/www/html/application/files && chmod -Rv 0775 /var/www/html/application/files"

permissions-web:
	docker exec -it aesatao_app sh -c "chown -Rv www-data:www-data /var/www/html"

permissions-config:
	docker exec -it aesatao_app sh -c "mkdir -p /var/www/html/application/config/generated_overrides && chown -Rv www-data:www-data /var/www/html/application/config/generated_overrides && chmod -Rv 0775 /var/www/html/application/config/generated_overrides"

permissions-cache:
	docker exec -it aesatao_app sh -c "mkdir -p /var/www/html/application/files/cache && chown -Rv www-data:www-data /var/www/html/application/files/cache && chmod -Rv 0775 /var/www/html/application/files/cache"

permissions-proxies:
	docker exec -it aesatao_app sh -c "mkdir -p /var/www/html/application/config/doctrine/proxies && chown -Rv www-data:www-data /var/www/html/application/config/doctrine/proxies && chmod -Rv 0775 /var/www/html/application/config/doctrine/proxies"

permissions-sitemap:
	docker exec -it aesatao_app sh -c "touch /var/www/html/sitemap.xml && chown -Rv www-data:www-data /var/www/html/sitemap.xml && chmod -Rv 0775 /var/www/html/sitemap.xml"

permissions:
	$(MAKE) permissions-web
	$(MAKE) permissions-files
	$(MAKE) permissions-config
	$(MAKE) permissions-cache
	$(MAKE) permissions-sitemap

deploy:
	$(MAKE) git-pull
	$(MAKE) build
	$(MAKE) stop-app
	$(MAKE) start
	$(MAKE) permissions
	$(MAKE) doctrine

export-db:
	docker exec -it -u root aesatao_db sh -c "cd /home && mysqldump -u root -pzzFVFrQyTK7IJxfpokfiAo4ZdO9kkYp56RqBGyM5iak6YA6sGmVUI0bvyYy3craC app > app.sql" && docker cp aesatao_db:/home/app.sql .

import-db:
	docker cp ./app.sql aesatao_db:/home && docker exec -it aesatao_db sh -c "cd /home && mysql -u root -pzzFVFrQyTK7IJxfpokfiAo4ZdO9kkYp56RqBGyM5iak6YA6sGmVUI0bvyYy3craC app < ./app.sql"

copy-db-staging-up:
	cd /Users/pedropiedade/Documents/http/pedro/aesatao && rsync -arv --stats --exclude='cache' app.sql root@104.248.36.69:/home/aesatao

sync-db:
	$(MAKE) export-db
	$(MAKE) build

sync-files-down:
	cd /Users/pedropiedade/Documents/http/pedro/aesatao/service/application && rsync -arv --stats --exclude='cache' root@68.183.78.54:/var/www/html/public/application/files .

sync-files-up:
	cd /Users/pedropiedade/Documents/http/pedro/aesatao/service/application/files && rsync -arv --stats --exclude='cache' . root@104.248.36.69:/home/aesatao/service/application/files

ssh:
	ssh -t root@104.248.36.69 "cd /home/aesatao; bash --login"

deploy-production:
	ssh -t root@104.248.36.69 "cd /home/aesatao && make deploy && exit ; bash --login"

generate-ai-context:
	docker exec -it aesatao_app sh -c "/var/www/html/concrete/bin/concrete task:generate-a-i-context"
