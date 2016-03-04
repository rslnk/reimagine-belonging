# CHANGELOG

## 1.7.0 March 5th, 2016

-   Better templates organization
-   Drop `event_post_type_slug_base` option
-   `setup.php` is now one place for all theme related settings
-   Drop custom `base-setup` mu-plugin in favour of `lib/ReBe/` classes and methods
-   Rewrite API data calls methods
-   Rewrite routing methods
-   Move theme API data methods to `lib/ReBe/API/`
-   Move theme routing methods to `lib/ReBe/Routing/`
-   Move theme ACF Pro custom fields JSON files to `lib/ReBe/Fields/`
-   Revise `NavWalker` class to accept menu class names dynamically
-   Move `NavWalker` class to `lib/WPBasic/Navigation/`
-   Introduce `lib/WPBasic/Post` classes and methods for more flexible custom post type registration
-   Sage templates wrapper and assets classes are now in `lib/Sage/`
-   Revise namespaces accross project's `.php` files
-   Revise `.php` files to comply with PSR2 coding standards
-   Revise `setup.php`, `helpers.php`, `filters.php` `admin.php`
-   Add Composer autoloader for files in `src/` and classes in `lib/`
-   Restracture theme in compliance with [Sage](https://github.com/roots/sage) 9.0
-   Add `wp-password-bcrypt` Composer plugin for more secure passwords ([#243](https://github.com/roots/bedrock/pull/243))
-   Update to Bedrock 1.5.4
-   Update to WordPress 4.4.2
-   Revise `CHANGELOG.md`

## 1.6.1 January 31st, 2016 (Checkpoint Charlie Grant Report)

-   Add `How-to` page content
-   Add `How-to` page template and styles
-   Fix lightbox class position propery
-   Give `Donation` button js class a unique name
-   Add `Workshops` page content
-   Add `Book a workshop` modal template
-   Add 'Workshops' page template and styles

## 1.6.0 January 22nd, 2016

-   Update README.md
-   Set default `DB_CHARSET` to `utf8mb4`
-   Fix `DISABLE_WP_CRON` setting via `ENV` variable
-   Disable WordPress post revisions
-   Add Amazon S3 and Cloudfront plugin for media files offload
-   Replace all `Sage` references with `ReBe`
-   Rename theme folder to `rebe`
-   Bump WordPress plugins versions
-   Bump WordPress to 4.1.1

## 1.5.0 December 22nd, 2015

-   Update `dotenv` and default theme in config

## 1.4.0 November 11th, 2015 (Google Talks, San Francisco)

-   Add donation button and lightbox modal window
-   Refactor `story` ng-app services and controllers

## 1.3.0 October 27th, 2015 (DOK Neuland Expo, Leipzig)

-   Add dynamic post navigation to `event` and `story` apps single views
-   Hide 'preview changes','view post' buttons from posts admin
-   Add content to `event` and `story` single post templates (for crawlers)
-   Add content to `event` and `story` list templates (for crawlers)
-   Add video meta tags for stories post videos
-   Add language (domain) switcher to site footer
-   Better `setup` organization
-   Remove ConditionalTagCheck class
-   Move opening `html` tag to `base.php`
-   Improve build and update dev dependencies

## 1.2.0 September 27th, 2015 (New York Launch)

-   Redesing 404 page
-   Redesing homepage (`front-page.php`)
-   Improved overall cosmetics (styles and layouts)
-   Add `event` app format date directive
-   Add pagination to `story` app list
-   Add 'closed caption' notice option for `story` post video
-   Add `story` post sidebar
-   Improve `event` post sidebar content styles
-   Fixed `story` list post preview hover animation glitch in Safari
-   Improve `story` app list filter
-   Improve HTTP redirects to use post types set from admin and dynamic `event_timeline` terms
-   Updated `Dotenv` to version 2, bump WordPress dependencies
-   Removed Capistrano and deploy configs in favour of [Trellis](https://github.com/roots/trellis)
-   Update Site Settings page options
-   Refactor `base-setup` mu-plugin
-   Install Yoast SEO Plugin
-   Update to WordPress 4.3.1

## 1.1.0 June 29th, 2015

-   Output `story` post `city` term
-   Improve `story` post single view styles
-   Improve `story` list preview styles (add greadient colors!)
-   Fix `story` list view grid issue
-   Add sidebar video and 'note' content to `event` post
-   Add sources and resources to `event` post
-   Reduce ng-apps preview images sizes (temporary solution)
-   Enhance `event` sources options
-   Fix lightbox cosmetics for both ng-apps
-   Update to Soil 3.4.0
-   Update to WordPress 4.2.2
-   Update to ACF Pro 5.2.6

## 1.0.0 May 5th, 2015 (Site Launch Event, Berlin)

-   Quick cosmetic patches before release
-   Temporary remove `sources` from `event` single post view
-   Add `story` ng-app list preview styles

## 0.9.0: May 4th, 2015

-   Add favicon
-   Add Facebook and Twitter sharing options to posts
-   Add Facebook SDK
-   Add Google site varification tag
-   Add video directive for single `story` post view
-   Add `story` single post view styles
-   Add `story` ng-app list styles
-   Add `prev`/`next` controls to timeline
-   Hide filtered out timeline events
-   Add ng-apps filter post counter
-   Add `story` topics filter
-   Add HTTP request redirects to ng-apps

## 0.8.0: May 3st, 2015

-   Add `story` ng-app
-   Fix `base` attribute for ng-apps
-   Normalise `events` app assets loading
-   Add load config feature before everything else in `events` app
-   Remove auto redirect from `events` app router
-   Update `404` template with content, markup and style
-   Add `page` template markup and styles
-   Add sidbar to `page` template
-   Fix main navigation toggle icon on mobile screen
-   Fix main navigation toggle
  - Add social icons to site footer
-   Use `rem` units for project's consistency

## 0.7.0: May 1st, 2015

-   Single and list `story` post API data output
-   Update site configuration API data output
-   Fix text editor `<p>` tags missing from API data output

## 0.6.0: April 30th, 2015

-   Add timeline corousel directive
-   Setup `story` single post options fields
-   Add basic typography and buttons styles
-   Add Proxima Nova and Open Sans font stacks
-   Add `toggle-menu` feature
-   Add homepage
-   Add header and footer

## 0.5.0: April 26th, 2015

-   Setup `.org` and `.de` production deployments
-   Add `events` ng-app with countries switcher feature and topics filter
-   Update to WordPress 4.2
-   Update ACF PRO to 5.2.3
-   Add password plugin
-   Remove `global_tags` meta box from `even` post edit page
-   Add post types and taxonomy slugs options to 'Site Settings' page
-   Add title and description options fields to `timeline` taxonomy terms
-   Add basic templates
-   Add iconify gulp task
-   Add `.svg` icons
-   Add `timeline` styles
-   Add basic styles (wrappers, buttons, etc)
-   Refactor styles and `stylus` files organization

## 0.4.1: April 18th, 2015

-   Add default timeline choice option to 'Site Settings' page
-   Add template specific settings to 'Site Settings' page
-   Add Google Analytics ID option 'Site Settings' page
-   Add UI elements labels options to 'Site Settings' page

## 0.4.0: April 15th, 2015

-   Add `dataFilter` class to API
-   Fix `event` dates custom fields input/output
-   Add `authors` custom filed to `event` post
-   Add data to single `event` post API data output
-   Add color option field to `event_group` taxonomy term
-   Add `sources` and `resources` options fields to `event` post
-   Add `event` post text editor and sidebar fields

## 0.3.0: April 7th, 2015

-   Syncronize test driven environment with web app
-   Make `event` post admin colums sortable by year
-   Add preview image to `event` post API data output
-   Fix typo in `event` post `start_date` field
-   Customize admin colums
-   Update `event` post basic data fields, bring back `the_title`
-   Add `page` templates
-   Add `timeline` page (`history/events`) template
-   AngularJS apps (ng-apps) setup and tests

## 0.2.2: April 4th, 2015

-   Update `event` post dates fields and API output to display full month and day
-   Add fields for `event` post related option
-   Change post thumbnail meta box title to 'Preview Image'
-   Remove `global_tag` meta box from `event` and `story` post types
-   Remove `story` post type `formats` taxonomy in favour of post formats

## 0.2.1: April 3rd, 2015

-   Fix repeater filds in API data output
-   Add API data output for `list-all-events` endpoint
-   Custom fields for `event` post type options
-   Update taxonomies for `event` and `story` post types
-   Add image, video and audio post formats to `story` post
-   Switch to `__DIR__` instead of `dirname(__FILE__)`
-   Don't register theme directory if `WP_DEFAULT_THEME` is defined

## 0.2.0: April 2nd, 2015

-   Add API data functions to `base-setup` mu-plugin
-   Set directory to save/load ACF Pro custom fields JSON files in `base-setup` mu-plugin
-   Add `base-setup` mu-plugin
-   Register 'Events' and 'Stories' post types and custom taxonomies
-   Customize WordPress admin panel
-   Update ACF Pro to 5.2.2
-   Remove `pleeease` dependency in favor of vanilla `gulp-autoprefixer` and `gulp-minify-css`

## 0.1.1: March 29th, 2015

-   Referencing Sage `ConditionalTagCheck` directly
-   Update all dev dependencies
-   Add `CHANGELOG.md`
-   Update ACF Pro to 5.2.1
-   Update to WordPress 4.1.1
-   Update Bedrock to 1.3.4

## 0.1.0: March 17th, 2015

-   Rename `\wwar-theme` directory to `\theme`
-   Rename project to Reimagine Belonging
-   Move repository from Bitbucket to GitHub
-   Update Roots to Sage 8.1.0
-   Configure deployment specific to Webfaction

## 0.0.1: February 7th, 2015

-   Add project documentation to README.md
-   Kouto-Swiss and Stylus
-   Remove Bootstrap and Less
-   Install Soil, ACF Pro, HTML5 Boilerplate .htaccess mu-plugins
-   Install Roots 8.0.0
-   Install Bedrock 1.3.1
