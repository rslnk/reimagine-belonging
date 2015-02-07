# [With Winds and Roots Interactive](http://withwingandroots.com)

**With Wings And Roots Interactive** project is build on [Bedrock](http://roots.io/wordpress-stack/), a modern WordPress stack and [Roots](http://roots.io/starter-theme/) starter theme that utilizes [HTML5 Boilerplate](http://html5boilerplate.com/) and modern development tools for easier website development.

* Source: [https://bitbucket.org/rslnk/wwar-interactive](https://bitbucket.org/rslnk/wwar-interactive)
* Homepage: [http://withwingandroots.com](http://withwingandroots.com)

## Requirements

* Git
* PHP >= 5.4
* Ruby >= 1.9 (for Capistrano)
* Node.js >= 0.10
* gulp (`npm install -g gulp`)
* Bower (`npm install -g bower`)

## Features

* Dependency management with [Composer](http://getcomposer.org)
* Automated deployments with [Capistrano](http://www.capistranorb.com/)
* Easy environment specific configuration
* [gulp](http://gulpjs.com/) for compiling Stylus, checking for JavaScript errors, live reloading, concatenating and minifying files, and versioning assets
* [Bower](http://bower.io/) for front-end package management
* [HTML5 Boilerplate](http://html5boilerplate.com/)
  * The latest [jQuery](http://jquery.com/) via Google CDN, with a local fallback
  * The latest [Modernizr](http://modernizr.com/) build for feature detection
  * An optimized Google Analytics snippet
* [Kuoto Swiss](http://kouto-swiss.io/)
* [Theme wrapper](http://roots.io/sage/getting-started/theme-wrapper/)
* Cleaner HTML output of navigation menus

## Installation/Usage

1. Fork git repo: `git clone https://rslnk@bitbucket.org/rslnk/wwar-interactive.git`
2. Edit `.env` and update environment variables:
  * `DB_NAME` - Database name
  * `DB_USER` - Database user
  * `DB_PASSWORD` - Database password
  * `DB_HOST` - Database host (defaults to `localhost`)
  * `WP_ENV` - Set to environment (`development`, `staging`, `production`, etc)
  * `WP_HOME` - Full URL to WordPress home (http://example.com)
  * `WP_SITEURL` - Full URL to WordPress including subdirectory (http://example.com/wp)
3. Set your Nginx or Apache vhost to `/path/to/site/web/` (`/path/to/site/current/web/` if using Capistrano)
5. Access WP Admin at `http://example.com/wp/wp-admin`

## Documentation

### Project's structure

```
├── Capfile
├── composer.json
├── config
│   ├── application.php
│   ├── deploy
│   │   ├── staging.rb
│   │   └── production.rb
│   ├── deploy.rb
│   └── environments
│       ├── development.php
│       ├── staging.php
│       └── production.php
├── Gemfile
├── vendor
└── web
    ├── app
    │   ├── mu-plugins
    │   ├── plugins
    │   └── themes
    │       └── wwar-theme
    ├── wp-config.php
    ├── index.php
    └── wp
```

The organization of this project is similar to putting WordPress in its own subdirectory but with some improvements.

* In order not to expose sensitive files in the webroot, Bedrock moves what's required into a `web/` directory including the vendor'd `wp/` source, and the `wp-content` source.
* `wp-content` has been named `app` to better reflect its contents. It contains application code and not just "static content". It also matches up with other frameworks such as Symfony and Rails.
* `wp-config.php` remains in the `web/` because it's required by WordPress, but it only acts as a loader. The actual configuration files have been moved to `config/` for better separation.
* Capistrano configs are also located in `config/` to make it consistent.
* `vendor/` is where the Composer managed dependencies are installed to.
* `wp/` is where the WordPress core lives. It's also managed by Composer but can't be put under `vendor` due to WordPress limitations.

### Configuration Files

The root `web/wp-config.php` is required by WordPress and is only used to load the other main configs. Nothing else should be added to it.

`config/application.php` is the main config file that contains what `wp-config.php` usually would. Base options should be set in there.

For environment specific configuration, use the files under `config/environments`. By default there's is `development`, `staging`, and `production` but these can be whatever you require.

The environment configs are required **before** the main `application` config so anything in an environment config takes precedence over `application`.

Note: You can't re-define constants in PHP. So if you have a base setting in `application.php` and want to override it in `production.php` for example, you have a few options:

* Remove the base option and be sure to define it in every environment it's needed
* Only define the constant in `application.php` if it isn't already defined.

### Environment Variables

Environment variables are used to separate config from code as much as possible. The benefit is there's a single place (`.env`) to keep settings like database or other 3rd party credentials that isn't committed to your repository.

[PHP dotenv](https://github.com/vlucas/phpdotenv) is used to load the `.env` file. All variables are then available in your app by `getenv`, `$_SERVER`, or `$_ENV`.

Currently, the following env vars are required:

* `DB_USER`
* `DB_NAME`
* `DB_PASSWORD`
* `WP_HOME`
* `WP_SITEURL`

### Managing dependencies with Composer

[Composer](http://getcomposer.org) is used to manage dependencies. Any 3rd party library considered as a dependency including WordPress itself and any plugins.

See these two blogs for more extensive documentation:

* [Using Composer with WordPress](http://roots.io/using-composer-with-wordpress/)
* [WordPress Plugins with Composer](http://roots.io/wordpress-plugins-with-composer/)

Screencast ($): [Using Composer With WordPress](http://roots.io/screencasts/using-composer-with-wordpress/)

#### Plugins

[WordPress Packagist](http://wpackagist.org/) is already registered in the `composer.json` file so any plugins from the [WordPress Plugin Directory](http://wordpress.org/plugins/) can easily be required.

To add a plugin, add it under the `require` directive or use `composer require <namespace>/<packagename>` from the command line. If it's from WordPress Packagist then the namespace is always `wpackagist-plugin`.

Example: `"wpackagist-plugin/akismet": "dev-trunk"`

Whenever you add a new plugin or update the WordPress version, run `composer update` to install your new packages.

`plugins`, and `mu-plugins` are Git ignored by default since Composer manages them. If you want to add something to those folders that *isn't* managed by Composer, you need to update `.gitignore` to whitelist them:

`!web/app/plugins/plugin-name`

Note: Some plugins may create files or folders outside of their given scope, or even make modifications to `wp-config.php` and other files in the `app` directory. These files should be added to your `.gitignore` file as they are managed by the plugins themselves, which are managed via Composer. Any modifications to `wp-config.php` that are needed should be moved into `config/application.php`.

#### Updating WordPress and plugin versions

Updating your WordPress version (or any plugin) is just a matter of changing the version number in the `composer.json` file.

Then running `composer update` will pull down the new version.

### Deploying with Capistrano

[Capistrano](http://www.capistranorb.com/) is a remote server automation and deployment tool. It will let you deploy or rollback your application in one command:

* Deploy: `cap production deploy`
* Rollback: `cap production deploy:rollback`

Composer support is built-in so when you run a deploy, `composer install` is automatically run. Capistrano has a great [deploy flow](http://www.capistranorb.com/documentation/getting-started/flow/) that you can hook into and extend it.

It's written in Ruby so it's needed *locally* if you want to use it. Capistrano was recently rewritten to be completely language agnostic, so if you previously wrote it off for being too Rails-centric, take another look at it.

Screencast ($): [Deploying WordPress with Capistrano](http://roots.io/screencasts/deploying-wordpress-with-capistrano/)

## Theme development

This project uses [gulp](http://gulpjs.com/) as its build system and [Bower](http://bower.io/) to manage front-end packages.

### Install gulp and Bower

**Unfamiliar with npm? Don't have node installed?** [Download and install node.js](http://nodejs.org/download/) before proceeding.

From the command line:

1. Install [gulp](http://gulpjs.com) and [Bower](http://bower.io/) globally with `npm install -g gulp bower`
2. Navigate to the theme directory `web/app/themes/wwari/`, then run `npm install`
3. Run `bower install`

You now have all the necessary dependencies to run the build process.

### Available gulp commands

* `gulp` — Compile and optimize the files in your assets directory
* `gulp watch` — Compile assets when file changes are made
* `gulp --production` — Compile assets for production (no source maps).
* `gulp --tasks` — Lists all the available tasks and what they do

#### Theme configuration

Edit `lib/config.php` to enable or disable theme features and to define a Google Analytics ID.

Edit `lib/init.php` to setup navigation menus, post thumbnail sizes, post formats, and sidebars.

## Must-use plugins

### Base theme setup
Custom plugin that automatically sets theme specific defaults:

* Updates permalink structure
* Sets respective blog and post pages for homepage and blog
* Sets uploads directory to `web/media`
* Sets uploads directory URL to `example.com/media`
* Disables year/month uploads sorting

### Soil
[Soil](https://github.com/roots/soil) plugin cleans up WordPress:

* Cleaner output of `wp_head` and enqueued assets
* Root relative URLs
* Nice search (`/search/query/`)

### ACF PRO
[ACF PRO](http://www.advancedcustomfields.com/pro/) plugin manages WordPress custom fields.

## Todo

* Vagrant/Ansible
* Solution for basic database syncing/copying

## Support

* Contact: [ruslan.komjakov@gmail.com](mailto:ruslan.komjakov@gmail.com)
* Use the [Roots Discourse](http://discourse.roots.io/) forum to ask questions and get support with Bedrock and Roots.