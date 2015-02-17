set :stage, :staging

# Path to staging directory
set :deploy_to, "/home/#{fetch(:rootuser)}/webapps/#{fetch(:application)}_staging"

# Sets branch to current one (overrides branch settings set in deploy.rb)
set :branch, proc { `git rev-parse --abbrev-ref HEAD`.chomp }

fetch(:default_env).merge!(wp_env: :staging)