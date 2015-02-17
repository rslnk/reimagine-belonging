set :stage, :production

# Path to staging directory
set :deploy_to, "/home/#{fetch(:rootuser)}/webapps/#{fetch(:application)}_production"

fetch(:default_env).merge!(wp_env: :production)