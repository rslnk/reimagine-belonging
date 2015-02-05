set :stage, :staging

# Simple Role Syntax
# ==================
#role :app, %w{deploy@example.com}
#role :web, %w{deploy@example.com}
#role :db,  %w{deploy@example.com}

# Extended Server Syntax
# ======================
#server 'example.com', user: 'deploy', roles: %w{web app db}

# Deploy to Staging directory
set :deploy_to, "/home/#{fetch(:user)}/webapps/#{fetch(:application)}_staging"

# Sets branch to current one
set :branch, proc { `git rev-parse --abbrev-ref HEAD`.chomp }

fetch(:default_env).merge!(wp_env: :staging)

# you can set custom ssh options
# it's possible to pass any option but you need to keep in mind that net/ssh understand limited list of options
# you can see them in [net/ssh documentation](http://net-ssh.github.io/net-ssh/classes/Net/SSH.html#method-c-start)
# set it globally
#  set :ssh_options, {
#    keys: %w(~/.ssh/id_rsa),
#    forward_agent: false,
#    auth_methods: %w(password)
#  }
