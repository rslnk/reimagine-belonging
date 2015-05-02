set :application, 'reimaginebelonging'
set :rootuser, 'wingsroots'
set :user, 'wingsroots'

set :scm, :git
set :repo_url, "git@github.com:rslnk/reimagine-belonging.git"

# Webfaction specific settings
server "#{fetch(:rootuser)}.webfactional.com", user: "#{fetch(:user)}", roles: %w{web app db}

# Set temp directory
set :tmp_dir, "/home/#{fetch(:rootuser)}/tmp"

# Run Composer update through SSHKit command
# Note that Composer must be installed in root user directory
SSHKit.config.command_map[:composer] = "php56 -d memory_limit=512M -d allow_url_fopen=1 -d suhosin.executor.include.whitelist=phar /home/#{fetch(:rootuser)}/composer/composer.phar"

# Branch options

# Hardcode branch to always be master
# This is overridden in a stage config file
set :branch, :master

# Use :debug for more verbose output when troubleshooting
set :log_level, :info

# Apache users with .htaccess files:
# it needs to be added to linked_files so it persists across deploys:
set :linked_files, fetch(:linked_files, []).push('.env', 'web/.htaccess')
set :linked_files, fetch(:linked_files, []).push('.env')
set :linked_dirs, fetch(:linked_dirs, []).push('web/media')

namespace :deploy do
  desc 'Restart application'
  task :restart do
    on roles(:app), in: :sequence, wait: 5 do
      # Your restart mechanism here, for example:
      # execute :service, :nginx, :reload
    end
  end
end

# The above restart task is not run by default
# Uncomment the following line to run it on deploys if needed
# after 'deploy:publishing', 'deploy:restart'

namespace :deploy do
  desc 'Update WordPress template root paths to point to the new release'
  task :update_option_paths do
    on roles(:app) do
      within fetch(:release_path) do
        if test :wp, :core, 'is-installed'
          [:stylesheet_root, :template_root].each do |option|
            # Only change the value if it's an absolute path
            # i.e. The relative path "/themes" must remain unchanged
            # Also, the option might not be set, in which case we leave it like that
            value = capture :wp, :option, :get, option, raise_on_non_zero_exit: false
            if value != '' && value != '/themes'
              execute :wp, :option, :set, option, fetch(:release_path).join('web/wp/wp-content/themes')
            end
          end
        end
      end
    end
  end
end

# The above update_option_paths task is not run by default
# Note that you need to have WP-CLI installed on your server
# Uncomment the following line to run it on deploys if needed
# after 'deploy:publishing', 'deploy:update_option_paths'

# Compile assets locally, copy assets to production/staging

set :theme_path, Pathname.new('web/app/themes/theme')
set :local_app_path, Pathname.new('~/Sites/reimaginebelonging/reimaginebelonging.dev')
set :local_theme_path, fetch(:local_app_path).join(fetch(:theme_path))

namespace :assets do
  task :compile do
    run_locally do
      within fetch(:local_theme_path) do
        #execute :gulp, '--production'
      end
    end
  end

  task :copy do
    on roles(:web) do
      upload! fetch(:local_theme_path).join('dist').to_s, release_path.join(fetch(:theme_path)), recursive: true
    end
  end

  task deploy: %w(compile copy)
end

before 'deploy:updated', 'assets:deploy'