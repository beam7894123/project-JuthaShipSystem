build:
	@docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(shell pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs

	@cp .env.example .env

	@./vendor/bin/sail up -d
	@./vendor/bin/sail artisan key:generate
	@./vendor/bin/sail yarn install

	@./vendor/bin/sail artisan storage:link
	@./vendor/bin/sail artisan migrate:fresh --seed

	@./vendor/bin/sail yarn dev

run:
	@echo "✩°｡⋆⸜(ू˙꒳​˙ )"
	@./vendor/bin/sail up -d
	@./vendor/bin/sail yarn dev

stop:
	@./vendor/bin/sail down
	@echo -e "\n\e[31m\e[42m\e[1m!!Shutdown End!!\e[0m ✩°｡⋆⸜(ू˙꒳​˙ )\e[0m"

fresh:
	@./vendor/bin/sail artisan migrate:fresh --seed

restart: stop run
shutdown: stop
down: stop
start: run

# Add 'sail' shortcut to user shell lol
# (Ref: https://laravel.com/docs/10.x/sail#configuring-a-shell-alias)
shortcut:
	echo "# Configure A Shell Alias" >> ~/.bashrc
	echo "alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'" >> ~/.bashrc

	@echo -e "\n\e[92m\e[1m \^w^/ Done! \n\e[4m\e[31m\e[103mDon't forget to restart your shell!\e[0m"

# Don't touch it, This mf scream so god damn loud >:<
test:
	echo "MEOWMEOMWEOMWOEMOWMEOWMEOMWEOMWOEMWOMEOWMMOEWMOEOWEMOWMEWMEWMEOAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA"
	echo -e "✩°｡⋆⸜(ू˙꒳​˙ )"

