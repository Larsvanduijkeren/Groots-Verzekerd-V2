namespace :dependencies do
    task :install do
        run_locally do
            execute "cd #{fetch(:root_folder)} && COMPOSER=.config/composer.json composer install"
        end
    end

    task :sync do
        run_locally do
            host = primary(:app)
            execute :rsync, "-a -e 'ssh -p #{host.port}'", "#{fetch(:root_folder)}/vendor/ #{host.username}@#{host.hostname}:#{release_path}/vendor/"
        end
    end

    task :dump do
        on roles(:app) do |host|
            execute "cd #{current_path} && COMPOSER=.config/composer.json php .config/composer.phar dump-autoload"
        end
    end
end
