set :stage, :production_de

# Path to staging directory
set :deploy_to, "/home/#{fetch(:rootuser)}/webapps/#{fetch(:application)}_de_production"

fetch(:default_env).merge!(wp_env: :production)