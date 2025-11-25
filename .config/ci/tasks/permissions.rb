namespace :permissions do
    task :fix do
        on roles(:app) do
            execute "find #{release_path} -type d -exec chmod 750 {} \\;"
            execute "find #{release_path} -type f -exec chmod 640 {} \\;"
        end
    end
end
