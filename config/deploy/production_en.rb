set :stage, :production_en

# Path to staging directory
set :deploy_to, "/home/#{fetch(:rootuser)}/webapps/#{fetch(:application)}_en_production"

fetch(:default_env).merge!(wp_env: :production)