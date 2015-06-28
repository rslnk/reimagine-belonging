set :stage, :staging

# Path to staging directory
set :deploy_to, "/home/#{fetch(:rootuser)}/webapps/#{fetch(:application)}_en_staging"

# Hardcode branch to be develop
set :branch, :develop

fetch(:default_env).merge!(wp_env: :staging)
