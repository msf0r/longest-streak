set :application, "Longest streak"
set :domain,      "188.166.124.176"
set :deploy_to,   "/var/www/ls"
set :app_path,    "app"
set :deploy_via, :rsync_with_remote_cache
set :branch,      "develop"

set :user, "deploy"
set :group,  "deploy"
set :use_sudo, false

set :use_composer, true
set :update_vendors,  false

set :repository,  ""
set :scm,         :git

set :model_manager, "doctrine"

role :web,        domain                         # Your HTTP server, Apache/etc
role :app,        domain, :primary => true       # This may be the same as your `Web` server

set  :keep_releases,  3

set :shared_files,      ["app/config/parameters.yml"]
set :shared_children,     [app_path + "/logs",  web_path + "/bundles", web_path + "/images"]
set :controllers_to_clear,  ['ap_*.php']


after "deploy:update_code" do
  capifony_pretty_print "--> Ensuring cache directory permissions"
  run "chmod -R 777 #{latest_release}/#{cache_path}"
  run "chown -R deploy:www-data #{latest_release}"
  capifony_puts_ok
end

set :keep_releases, 3
after "deploy:update", "deploy:cleanup"
