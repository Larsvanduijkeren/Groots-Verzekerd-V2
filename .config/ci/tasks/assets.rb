namespace :assets do
    task :install do
        run_locally do
            execute "cd #{fetch(:root_folder)}/#{fetch(:theme_folder)} && yarn install"
        end
    end
    task :compile do
        run_locally do
            execute "cd #{fetch(:root_folder)}/#{fetch(:theme_folder)} && yarn build"
        end
    end
end
