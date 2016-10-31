# config valid only for current version of Capistrano
# lock '3.5.0'

set :application, 'lannaliving'
set :repo_url, 'git@gitlab.com:wisdomlanna/lannaliving_backend.git'
set :linked_files, fetch(:linked_files, []).push('.env', 'public/.htaccess')
set :linked_dirs, fetch(:linked_dirs, []).push('public/content')

# Default branch is :master
# ask :branch, `git rev-parse --abbrev-ref HEAD`.chomp

# Default deploy_to directory is /var/www/my_app_name
# set :deploy_to, '/var/www/my_app_name'

# Default value for :scm is :git
# set :scm, :git

# Default value for :format is :airbrussh.
# set :format, :airbrussh

# You can configure the Airbrussh format using :format_options.
# These are the defaults.
# set :format_options, command_output: true, log_file: 'log/capistrano.log', color: :auto, truncate: :auto

# Default value for :pty is false
# set :pty, true

# Default value for :linked_files is []
# set :linked_files, fetch(:linked_files, []).push('config/database.yml', 'config/secrets.yml')

# Default value for linked_dirs is []
# set :linked_dirs, fetch(:linked_dirs, []).push('log', 'tmp/pids', 'tmp/cache', 'tmp/sockets', 'public/system')

# Default value for default_env is {}
# set :default_env, { path: "/opt/ruby/bin:$PATH" }

# Default value for keep_releases is 5
# set :keep_releases, 5

namespace :laravel do

    desc 'Set laravel folder permissions'
      task :permission do
        on roles(:web), in: :sequence, wait: 1 do
        within release_path do
          execute :chmod, "-R o+w storage"
          execute :chmod, "-R o+w bootstrap/cache"
          execute :chmod, "-R o+w public/content"
        end
      end
    end

    desc 'Run laravel database migration'
      task :migration do
        on roles(:web), in: :sequence, wait: 1 do
        within release_path do
          execute :php,:artisan,:migrate,"--force" #"artisan migrate"
        end
      end
    end

end

namespace :composer do

    desc 'Pre Composer Install'
    task :preinstall do
        on roles(:web), in: :sequence, wait: 1 do
        within release_path do
          execute :composer,"require 'acacha/admin-lte-template-laravel:2.*'"
          execute :composer,"require barryvdh/laravel-ide-helper"
        end
    end
    end

    desc 'Composer Install'
    task :install do
        on roles(:web), in: :sequence, wait: 1 do
        within release_path do
          execute :composer,"install --no-dev"
        end
    end
    end

    desc 'Composer Update'
    task :update do
        on roles(:web), in: :sequence, wait: 1 do
        within release_path do
          execute :composer,"install --no-dev"
        end
    end
    end

end

namespace :deploy do
    after :updated, 'composer:install'
    after :updated, 'laravel:permission'
    after :updated, 'laravel:migration'

  after :restart, :clear_cache do
    on roles(:web), in: :groups, limit: 3, wait: 10 do
      # Here we can do anything such as:
      # within release_path do
      #   execute :rake, 'cache:clear'
      # end
    end
  end

end
