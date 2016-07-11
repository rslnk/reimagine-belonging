# CHANGELOG

# 2.1.0 July 11th, 2016

-   Switch to manual `perPage` value in Stories/Workshops ng-apps until better solution
-   Replace `title` attr with `thetitle` to avoid alt text showing up on `ng-mouseenter`
-   Update Facebook SDK, fix `facebook_app_id` call in ng apps
-   Fix social links conditional statements in footer
-   Fix `type` fields in Workshop ng app templates
-   Improve ng app posts previews templates and styles
-   Improve `dateFormat` directive for events ng app (now supports US date format)
-   Replace `$scope` with `viewModel` in ng controllers
-   Sort timeline events by event `start_date` instead of the `year`
-   Add event year to API
-   Update `ng-lodash` to 0.5.0
-   Add `resourceUrlWhitelist` to ng apps to allow resource loading from trusted sources
-   Improve timeline carousel UX and UI
-   Switch to Owl Carousel 2, add it to bower
-   Add helper function that constructs video embed code from video ID and host (legacy support for WP templates)
-   Switch `video_url` field type to oEmbed to support embeded from the URL on WP templates
-   Add page sidebar image orientation options to WP templates

# 2.0.0 July 4th, 2016

-   Update to ACF Pro 5.3.9
-   Update to WordPress 4.5.3
-   Smaller caption font-size on workshop previews
-   Remove Location taxonomy and options from 'Wokrshops' ng app, admin UI and API
-   Fix 'Event' post sidebar featured story video URL and hero name
-   Add post sidebar image orientation options (landscape/portrait, fit)
-   Rename Story post UI colors options in compliance with RB palette colors names
-   Remove 'audio' post format, hide 'post-formats' from Story admin UI
-   Add conditional logic to video ID and video host fields in admin UI
-   Switch from `anguvideo` to `ng-videosharing-embed` module
-   Add `video.service` to ng apps that checks if video is provided via ID/host or URL
-   Add `video_url` fields to Story editor and posts sidebars, add to API
-   Set 'Stories' and 'Workshop' ng apps to use post per pages settings from the site config
-   Set dynamic cookie name (based on provide ng apps base slugs)
-   Refactor ngCookies in compliance with Agular 1.5.8
-   Refactor ng apps services
-   Refactor ng apps controllers/directives/modules names
-   Refactor ng apps code in compliance with Angular standards
-   Bump angular packages versions
-   Bump angular version 1.5.8
-   Improve content editors fields UI
-   Improve 'Story' basic info backend UI (make use of `story_city`, `story_person` taxonomy)
-   Use secure hhtps connection for ng apps videos
-   Use secure `https` urls for theme fonts assets requests
-   Update `screenshot.png` and theme version
-   Remove 'Events' ng app `timelineSwitcher` directive, simply use ng-click instead
-   Fix 'Events' ng app `dateformat` directive
-   Fix `function.php` includes and Composer autoload
-   Replace 'language' with 'type' on workshop preview

## 1.9.4 June 10th, 2016

-   Update .gitignore to exclude `templates/` dir
-   Add featured story, featured workshop to 'Event' post
-   Add related posts feature to 'Story' post
-   Add related posts feature to 'Events' post

## 1.9.3 May 31th, 2016

-   Implement ng app for 'Workshop' post type
-   Rewrite 'Events' and 'Stories' ng templates with Jade
-   Add Jade templates task for ng templates
-   Add 'Page' post type to API
-   Add 'Workshop' post type and app settings to API
-   Split `partials` template folders for `wp` and `ng` templates

## 1.9.2 May 25th, 2016

-   Change 'Events' dash icon
-   Improve Site Settings, Dictionary and Advanced settings tabbed layout
-   Add human readable 'Event' date to helpers function
-   Add helpers function that outputs post taxonomy terms names
-   Add custom post url constructor to helpers functions
-   Add reusable preview templates (crawler)
-   Move 'Event' sidebar includes to `partials/media-blocks` to make it reusable with other post types (crawler)
-   Add related posts to 'Event', 'Story', 'Workshop' templates (crawler)
-   Add lead text field to 'Event article' fields group, output it in API and ng template
-   Drop defualt page template sidenote field in favour of `The content` sidebar
-   Drop default content editor for page template in favour of `The content` custom field group
-   Rename page `subtitle` field to `page_title` make it exclusive to default page templates
-   Add page titles to 'Event' and 'Story' page templates (crawler)
-   Extend 'Workshop' templates with data fields (crawler)
-   Add 'Workshop' options to Site Settings and Dictionary
-   Add 'Workshop' post specific fields group
-   Add 'Workshop' page and single templates
-   Reorganize WordPress admin menu order
-   Register 'Workshop' post type and its taxonomies

## 1.9.1 May 24th, 2016

-   Add google plus to post sharing options
-   Add `angularjs-socialshare` and imporove UX of posts social sharing
-   Add dinamic accessability labels to navigation elements (such as social links)
-   Improve API 'Services' fields names in Site Settings and Dictionary
-   Fix include of social links in footer template
-   Minor 'Event', 'Story', 'Page' templates cosmetic tweaks
-   Add 'Share Story' lable to 'Story' template sidebar
-   Improve share post options hover animation
-   Move category list to main content on 'Story' template
-   Move category list to sidebar on 'Event' template
-   Add head background image to 'Page' template
-   Add drop caps style to 'Page' template

## 1.9.0 May 23rd, 2016

-   Remove hardcoded 'how-to' (guide) and 'workshops' templates
-   Rename 'Timeline' tabs in Site Settings to Event
-   Rename `template-timeline.php` to `template-events.php`
-   Simplify 'events' and 'stories' templates intended for crawlers (no need for cosmetic styles)
-   Improve ui routing for custom post types
-   Add timeline taxonomy terms to 'event' post slug for URL consistency between ng app and crawler
-   Add `templates` directory content to `.gitignore`
-   Re-write all PHP templates with Jade
-   Add `gulp-jade-php` task to `gulp`
-   Update `amazon-s3-and-cloudfront` and `wordpress-seo` plugins
-   Update to ACF Pro 5.3.8
-   Update to WordPress 4.5.2

## 1.8.0 May 19th, 2016

-   Add 'events' and 'stories' page titles to side dictionary
-   Update default page head desing
-   Improve h2-h6 scope styles when used in WordPress editor
-   Drop 'play' icon from 'story' preview
-   Improve 'story' previews colors, font size and animations
-   Improve timeline and 'event' preview design, add animations
-   Move post sharing options to sidebar
-   Adapt to new homepage design
-   Add improved logotype
-   Improve typography (shift from uppercase)
-   Improve all existing styles
-   Add `.stylintrc` — stylus linter rules
-   Improve `.styl` files commentaries
-   Split styles and reorganize by directories
-   Improve design addaptation to mobile portrait/landscape and hd screens
-   Switch from Kouto-Swiss media queries to Rupture

## 1.7.0 March 9th, 2016

-   Rename home tagline and buttons option fields
-   Move home tagline options out of 'Dictionary' to 'Site Settings'
-   Move home buttons options out of 'Dictionary' to 'Site Settings'
-   Rename donate buttons option fields
-   Move donate buttons options out of 'Dictionary' to 'Site Settings'
-   Rename language switcher options fileds to `locale`
-   Move language switcher options out of 'Dictionary' to 'Site Settings'
-   Move social links options out of 'Dictionary' to 'Site Settings'
-   Add missing UI accesibilty options to 'Dictionary'
-   Add footer directory sections titles options to 'Dictionary'
-   Add social links url and alt text options to 'Dictionary'
-   Register additional menus
-   Add new large footer with multiple menus and mobile navigation
-   Revise mobile menu: add modal menu for mobile screens
-   Add individual color backdrops to 'story' view
-   Add hover states and animation to main UI elements
-   Remove JavaScript functions for lightbox height
-   Drop lightbox class name in favour of `o-overlay` with new properties
-   Improve closed caption notice design
-   Improve `<blockquote`> design
-   Update event year design in 'event' view
-   Update 'event' footnotes layout
-   Update 'event' cateogories list desing
-   Fix 'events' and 'stories' categories filter hover effect
-   Switch to Jeet grid system
-   Update icons desing, markup and style properties
-   Drop `gulp-iconify` in faovour of `gulp-iconfont`
-   Refactor style class names and namespaces
-   Refactor styles structure (inspired by [Harry Roberts](http://csswizardry.com/) ITSCC)
-   Set ng-apps templates path to `src/views/ng-apps`
-   Move `HTML` out of ng-apps directives to separtate template files
-   Revise AngularJS directives names
-   Remove outdated tests
-   Move AngularJS files from `ng/` to `scripts/`
-   Move `assets/` to `src/`
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
