# [Reimagine Belonging Website](http://www.reimaginebelonging.com)

**Reimagine Belonging** is a multimedia project that explores question of migration, citizenship and belonging by utilizing video documentary, academic research and modern web technology. This is non-profit, open-source project which is made possible by a collaborative effort of volunteers across the globe.


**Follow** Reimagine Belonging on [Facebook](https://www.facebook.com/withWINGSandROOTS), [Twitter](https://twitter.com/wingsrootsfilm).

You can also check our [public roadmap](http://#) on Trello or sign up to our [newsletter](http://#) to stay up to date with the project' development.

## The Content

The website's core content consists of two main sections: a collection of [video interviews](http://www.reimaginebelonging.com/stories) with children of immigrants and a selection of [historical events](http://www.reimaginebelonging.com/history) that caused migration or in some way connected to questions of migration, citizenship and belonging.

Currently, the project researches history of migration, citizenship and belonging in the United States and Germany and the project's content is is available in [English](http://www.reimaginebelonging.com) and [German](http://www.reimaginebelonging.de). However we are looking forward to expand our research base to other countries/regions.

You are welcome to join our multinational team to help with the research or translation of the content to other languages.

**Our content repositories:**

* United States timeline events (URL)
* Germany timeline events (URL)
* Video interviews subtitles (URL)

You are welcome to contribute to any of these repositories including [this one](https://github.com/rslnk/reimagine-belonging). We have [Contributing Guidelines](https://github.com/rslnk/reimagine-belonging/blob/master/CONTRIBUTING.md) to help you get started. If you have any questions or would like to contribute to the project in some other way, just [drop us a line](mailto:christina@withwingsandroots.com)!

## The Website

This website is build with WordPress, using [Bedrock](https://roots.io/bedrock) development stack and [Sage](ttps://roots.io/sage) as a base/starter theme and [AngularJS](https://angularjs.org) for dynamic HTML views used in [Stories Collection](http://www.reimaginebelonging.com/stories) and in [Timeline](http://www.reimaginebelonging.com/stories) events.

### Features

* [WordPress](https://wordpress.org) for website's content management
* [Bedrock](https://roots.io/bedrock) development tools and WordPress project structure
* [Composer](http://getcomposer.org) for dependency management
* [Capistrano](http://www.capistranorb.com) for automated deployment
* [Vagrant](https://www.vagrantup.com) and [Ansible](https://github.com/roots/bedrock-ansible) for server environments
* [Gulp](http://gulpjs.com) build script for automated workflow
* [Bower](http://bower.io) for front-end package management
* [BrowserSync](http://www.browsersync.io) for synchronized browser testing
* [asset-builder](https://github.com/austinpray/asset-builder) for assembling dependencies in order to run them through asset pipeline
* [AngularJS](https://angularjs.org) for HTML dynamic views
* [Kouto Swiss](http://kouto-swiss.io) CSS toolbox for Stylus
* [Soil](https://github.com/roots/soil) plugin for cleaner WordPress markup, root relative URLs and [other optimizations](### Soil plugin)
* [ACF PRO](http://www.advancedcustomfields.com) plugin for building edit screens and custom field data management
* HTML5 Boilerplate's .htaccess [plugin](https://github.com/roots/wp-h5bp-htaccess)

## Installation and development setup

The following documentation contains step by step instructions on how to install project on your local machine and should help you get started with [Reimagine Belonging](http://www.reimaginebelonging.com) website development.

### Requirements

* Git
* PHP >= 5.4
* Ruby >= 1.9 (for Capistrano)
* Node.js >= 0.10 — [Install](https://nodejs.org/download)
* npm >=2.1.5 — [Install](https://www.npmjs.com/package/latest-version)
* Gulp (`npm install -g gulp`)
* Bower (`npm install -g bower`)
* Ansible >= 1.8 (except 1.9.1 - see this [bug](https://github.com/roots/bedrock-ansible/issues/205)) - [Install](http://docs.ansible.com/intro_installation.html) • [Docs](http://docs.ansible.com/)
* Virtualbox >= 4.3.10 - [Install](https://www.virtualbox.org/wiki/Downloads)
* Vagrant >= 1.5.4 - [Install](http://www.vagrantup.com/downloads.html) • [Docs](https://docs.vagrantup.com/v2/)
* vagrant-bindfs >= 0.3.1 - [Install](https://github.com/gael-ian/vagrant-bindfs#installation) • [Docs](https://github.com/gael-ian/vagrant-bindfs) (Windows users may skip this)
* vagrant-hostsupdater - [Install](https://github.com/cogitatio/vagrant-hostsupdater#installation) • [Docs](https://github.com/cogitatio/vagrant-hostsupdater)

### Development server

For your WordPress ready local server we recommend using [bedrock-ansible](https://github.com/roots/bedrock-ansible). This will ensure development & production parity and will allow you to create development environment with a single command line.

To install this repo and setup your WordPress ready local server follow these steps:

1. Create a project directory: `mkdir reimaginebelonging.com && cd reimaginebelonging.com`
2. Clone bedrock-ansible: `git clone --depth=1 git@github.com:roots/bedrock-ansible.git ansible && rm -rf ansible/.git`
3. Clone this repo: `git clone --depth=1 git@github.com:rslnk/reimagine-belonging.git site`
4. Move `Vagrantfile` to root: `mv ansible/Vagrantfile .` and update the [ANSIBLE_PATH](https://github.com/roots/roots-example-project.com/blob/master/Vagrantfile#L6) to `'ansible'`.
5. Go to `ansible/` dir and run `ansible-galaxy install -r requirements.yml` to install external Ansible roles/packages.
6. Install `vagrant plugin install vagrant-hostsupdater`. This [Vagrant plugin](https://github.com/cogitatio/vagrant-hostsupdater#installation) adds an entry to your /etc/hosts file on the host system.
7. Install `vagrant plugin install vagrant-bindfs`. A [Vagrant plugin](https://github.com/gael-ian/vagrant-bindfs#installation) to automate bindfs mount in the VM.
8. Edit `group_vars/development` and add your local WordPress site. We recommend setting dev URL to `reimaginebelonging.dev`.
9. Run `vagrant up` from `reimaginebelonging.com/` dir.

You should now have the following directories:

```
reimaginebelonging.com/   - Primary folder for this project
├── Vagrantfile
├── ansible/              - bedrock-ansible repo renamed to just `ansible`
└── site/                 - reimagine-belonging repo renamed to just `site`
```

Note on `.env` files: You **do not** need a configured `.env` file. bedrock-ansible will automatically create and configure one.

### Development setup

This project uses [Gulp](http://gulpjs.com) as its build system and [Bower](http://bower.io) to manage front-end packages. To get started with the building process make sure your development machine meets the following requirements:

| Prerequisite    | Check version | How to install
| --------------- | ------------- | ------------- |
| Node.js 0.12.x  | `node -v`     | [nodejs.org](http://nodejs.org) |
| gulp >= 3.8.10  | `gulp -v`     | `npm install -g gulp` |
| Bower >= 1.3.12 | `bower -v`    | `npm install -g bower` |

We recommend you update to the latest version of npm: `npm install -g npm@latest`.

**Install Gulp, Bower and build dependencies:**

1. Install [Gulp](http://gulpjs.com) and [Bower](http://bower.io) globally with `npm install -g gulp bower`
2. Navigate to the theme directory `web/app/themes/theme/`, then run `npm install`
3. Run `bower install`

You now have all the necessary dependencies to run the build process.

## Project structure & configuration

Reimagine Belonging website utilizes [Bedrock project organization](https://github.com/roots/bedrock/wiki/Folder-structure), which is similar to putting WordPress in its own subdirectory:

* All required files are stored in `web/` directory including the vendor'd `wp/` source, and the `wp-content` source.
* `wp-content` has been named `app` to better reflect its contents.
* `wp-config.php` remains in the `web/` because it's required by WordPress, but it only acts as a loader. The actual configuration files have been moved to `config/` for better separation.
* `vendor/` is where the Composer managed dependencies are installed to.
* `wp/` is where the WordPress core lives.

```
site/
├── Capfile
├── composer.json
├── config/
│   ├── application.php
│   ├── deploy/
│   │   ├── staging.rb
│   │   └── production.rb
│   ├── deploy.rb
│   └── environments/
│       ├── development.php
│       ├── staging.php
│       └── production.php
├── Gemfile
├── vendor/
└── web/
    ├── app/
    │   ├── mu-plugins/
    │   ├── plugins/
    │   └── themes/
    │       └── theme/
    ├── media/
    ├── index.php
    ├── wp-config.php
    └── wp/
```

### Configuration files

`config/application.php` is the main config file that contains what `wp-config.php` usually would. Base options are set in there.

For environment specific configuration, use the files under `config/environments`.

## Website development

Reimagine Belonging WordPress theme files are stored in `web/app/themes/theme/`. To start working on the development or run building process use:

### Available Gulp commands

* `gulp` — Compile and optimize the files in your assets directory
* `gulp watch` — Compile assets when file changes are made
* `gulp --production` — Compile assets for production (no source maps).
* `gulp --tasks` — Lists all the available tasks and what they do

### Using BrowserSync

To use BrowserSync during `gulp watch` your local development hostname should be set to `http://reimaginebelonging.dev` to reflect `devUrl` set at the bottom of `assets/manifest.json`.

### Application folder structure

```
app/
├── mu-plugins/
│   ├── acf-pro/
│   ├── base-setup/
│   ├── soil/
│   ├── bedrock-autoloader.php
│   ├── disallow-indexing.php
│   └── register-theme-directory.php
├── plugins/
└── themes/
    └── theme/                  - Reimagine Belonging WordPpress theme includes build script, templates and assets
        ├── assets/             - Build assets
        │   ├── fonts
        │   ├── icons           - svg icons
        │   ├── images
        │   ├── ng              - AngularJS apps
        │   ├── scripts         - JavaScripts
        │   ├── styles          - CSS styles
        │   └── manifest.json
        ├── dist/               - Distributives
        ├── e2e/                - Build tests for AngularJS apps
        ├── lib/                - Site config
        ├── templates/          — WordPress content templates
        ├── gulpfile.js         — Build script
        └── packages.json       — Build dependencies
```

### Managing WordPress dependencies with Composer

[Composer](http://getcomposer.org) is used to manage any 3rd party library like WordPress plugins as a dependency including WordPress itself.

All plugins required for Reimagine Belonging to run delcared in `/composer.json` file. Any new plugin must be added under the `require` directive. Namespace  for WordPress plugins from WordPress Packagist is always `wpackagist-plugin`.

Whenever a new plugin is being added or the WordPress version updated, a `composer update` command should be run in order to install new packages.

`plugins`, and `mu-plugins` are Git ignored by default since Composer manages them. Custom plugins that *aren't* managed by Composer, are whitelisted in `/.gitignore` file.

## Deployment

[Capistrano](http://www.capistranorb.com/) is used as a deployment method to deploy Reimagine Belonging website to a remote server. It allows to deploy or rollback deployments in one command.

**Available deployment commands:**

* `cap production_en deploy`
* `cap production_de deploy`
* `cap staging deploy`

To rollback a deploy use `cap production_en deploy:rollback`

Composer support is built-in so when you run a deploy, `composer install` is automatically run. Capistrano has a great [deploy flow](http://www.capistranorb.com/documentation/getting-started/flow/) that you can hook into and extend it.

## Must-use plugins

The following must-use WordPress plugins are required in order for Reimagine Belonging website to work:

* Base Setup >= 1.0
* [Soil](https://roots.io/plugins/soil) >= 3.3.0
* [ACF PRO](http://www.advancedcustomfields.com/pro) >= 5.2.5

### Base Setup plugin

Site specific mu-plugin that automatically sets the following WordPress defaults:

* Sets upload path to /media;
* Sets upload path URL to example.com/media
* Disables year/month folder structure for uploads
* Sets permalink structure to post name
* Creates data api endpoint URL
* Sets save/load path to ACF PRO JSON custom fields

### Bedrock Autoloader plugin

An autoloader that enables standard plugins to be required just like must-use plugins. The autoloaded plugins are included after all mu-plugins and standard plugins have been loaded.

### Disallow Indexing plugin

Disallow indexing on non-production environments.

### Soil plugin

[Soil](https://roots.io/plugins/soil) is a WordPress plugin which contains a collection of modules to apply theme-agnostic front-end modifications.

* Loads jQuery from Google’s CDN with a local fallback (as recommended by HTML5 Boilerplate)
* Cleaner output of WordPress `wp_head` and enqueued assets
* Cleaner output of walker for WordPress navigation menus
* Replaces WordPress absolute URLs with root relative URLs
* Redirects search results from /?s=query to /search/query/
* Support for HTML5 Boilerplate’s Google Analytics snippet
* Forces all WordPress enqueued JavaScript to the footer
* Globally disables trackbacks and pingbacks
* Removes the version query string from all styles and scripts.

### ACF PRO plugin

[ACF PRO](http://www.advancedcustomfields.com/pro) plugin for building edit screens and custom field data management.

### HTML5 Boilerplate's .htaccess plugin

[wp-h5bp-htaccess plugin](https://github.com/roots/wp-h5bp-htaccess) provides HTML5 Boilerplate's .htaccess for WordPress.

## Contributing

Contributions are welcome from everyone. We have **contributing guidelines** (URL) to help you get started.
