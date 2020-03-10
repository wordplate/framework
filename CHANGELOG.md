# CHANGELOG

## 8.1.0 (upcoming)

- Replaced vlucas/dotenv with symfony/dotenv 

## 8.0.0 (released 2019-11-25)

- Added HTTPS detection behind a reverse proxy or a load balancer
- Added WP_DISABLE_FATAL_ERROR_HANDLER constant
- Updated application class to non-final
- Updated dotenv to 8.2.0
- Updated johnpbloch/wordpress to 5.3
- Updated cross-env to 6.0.0
- Updated laravel-mix to 5.0.0
- Updated symfony/http-foundation to 5.0
- Updated symfony/routing to 5.0
- Updated symfony/var-dumper to 5.0
- Updated wordplate/plate to 6.0
- Removed mix, asset, stylesheet_url and template_url functions
- Removed base_path, stylesheet_path and template_path functions
- Removed ext-mbstring dependency
- Removed hot reloading support
- Removed illuminate/support and laravel/helpers packages
- Removed PHP 7.1 support
- Removed template_slug function

## 7.1.0 (released 2019-02-27)

- Added laravel/helpers package
- Deleted robots.txt file
- Removed deprecated bloginfo function
- Updated illuminate/support to 5.8
- Updated johnpbloch/wordpress to 5.1
- Updated laravel-mix to 4.0.14
- Updated vlucas/phpdotenv to 3.0
- Updated wordplate/plate to 4.1

## 7.0.0 (released 2018-12-12)

- Added template_slug helper function
- Removed WP_ENV environment variable
- Updated default path to base path
- Updated johnpbloch/wordpress to 5.0
- Updated laravel-mix to 4.0
- Updated default npm scripts
- Updated plugin loader registration

## 6.3.1 (released 2018-09-14)

- Added relative path support for mu-plugins
- Updated resources directory structure
- Updated composer/installers to 1.7.0
- Updated cross-env to 5.2.0
- Updated illuminate/support to 5.7.0
- Updated vlucas/phpdotenv to 2.5.0

## 6.3.0 (released 2018-06-04)

- Added stylesheet url helper function
- Added template url helper function
- Added browserslist to package.json
- Updated cross-env to 5.1.6
- Updated dotenv to 6.0.0
- Updated johnpbloch/wordpress to 4.9.6
- Updated symfony/http-foundation to 4.1.0
- Updated symfony/routing to 4.1.0
- Updated symfony/var-dumper to 4.1.0

## 6.2.2 (released 2018-04-04)

- Updated default favicon
- Updated laravel-mix to 2.1.11
- Updated cross-env to 5.1.4
- Updated menu registration
- Updated wordpress core to 4.9.5
- Removed stylesheet loading from theme
- Removed unused filters

## 6.2.1 (released 2018-03-05)

- Added plate 4.0 support
- Updated illuminate support to 5.6
- Updated wordpress core to 4.9.4

## 6.2.0 (released 2018-01-25)

- Added must-use plugin loader
- Added symfony 4.0 support
- Added mail encryption variable
- Added laravel mix 2.0 support
- Updated child theme support
- Updated wordpress core
- Removed php 7.0 support

## 6.1.0 (released 2017-11-16)

- Add dotenv to laravel mix
- Fix javascript paths for windows
- Update composer installers
- Update laravel mix
- Update wordpress core

## 6.0.0 (released 2017-10-05)

- Add stylesheet path helper
- Add shorthand bloginfo helper
- Update documentation
- Update illuminate support
- Update laravel mix
- Remove deprecated code

## 5.3.1 (released 2017-06-21)

- Update laravel mix
- Update mix helper function
- Fixed assets directory bug

## 5.3.0 (released 2017-06-20)

- Update illuminate support
- Update laravel mix
- Update wordpress
- Update symfony packages

## 5.2.2 (released 2017-05-31)

- Add core update constant

## 5.2.1 (released 2017-05-10)

- Update laravel mix config
- Fix target blank issue

## 5.2.0 (released 2017-05-09)

- Add debug log constant
- Fix bugs and typos
- Remove deprecated wp_title filter
- Update documentation
- Update mail plugin
- Update plate plugin

## 5.1.0 (released 2017-04-27)

- Add container class
- Add base_path helper function
- Add mu-plugins to gitignore

## 5.0.4 (released 2017-04-24)

- Add public path property

## 5.0.3 (released 2017-04-18)

- Fix wp-cli support
- Update default database charset
- Update table prefix variable

## 5.0.2 (released 2017-04-01)

- Added new theme assets

## 5.0.1 (released 2017-03-28)

- Added environment variables
- Updated environment loader

## 5.0.0 (released 2017-03-27)

- Added asset() helper
- Added template_path() helper
- Added Application class
- Updated HTTPS support
- Updated logo and website
- Removed deprecated helpers
- Removed elixir() helper

## 4.3.0 (released 2017-01-29)

- Added Laravel Mix
- Update Laravel to 5.4
- Update Symfony to 3.2
- Update WordPress to 4.7
- Remove PHP 5.6 support

## 4.2.0 (released 2016-07-11)

- Drop php 5.5 support
- Update Laravel to 5.3
- Update Symfony to 3.1
- Remove UUID plugin by default

## 4.1.3 (released 2016-05-05)

- Remove Soil link

## 4.1.2 (released 2016-05-02)

- Remove Soil plugin

## 4.1.1 (released 2016-04-29)

- Update multisite support

## 4.1.0 (released 2016-04-28)

- Add mail plugin
- Add multisite plugin
- Add uuid plugin
- Deprecate ACF helpers method
- Update documentation
- Update plate plugin

## 4.0.7 (released 2016-04-04)

- Add Illuminate support package
- Add back ext-mbstring requirement

## 4.0.6 (released 2016-04-03)

- Dropped ext-mbstring requirement
- Update elixir manifest caching
- Improved documentation

## 4.0.5 (released 2016-03-20)

- Move documentation to README
- Move library to Plate plugin
- Replace permalink GUIDs with UUIDs

## 4.0.4 (released 2016-03-06)

- Remove unused Whoops dependency
- Add WordPlate website links
- Cleanup license headers

## 4.0.3 (released 2016-03-04)

- Add ACF helpers methods
- Add elixir helper method
- Add revisions to style and script assets
- Update library structure

## 4.0.2 (released 2016-03-02)

- Add roots/wp-password-bcrypt package
- Add version number to theme
- Hide welcome panel by default
- Remove author and description meta tags

## 4.0.1 (released 2016-03-01)

- Update theme paths
- Update wpackagist url
- Bugfixes

## 4.0.0 (released 2016-02-29)

- Add new test suit
- Add custom dd(), env() and value() helper methods
- Update Elixir to latest version
- Move WordPress logic out of the framework
- Remove plate CLI helper
- Remove Laravel components
- Remove config repository

## 3.1.1 (released 2016-01-20)

- Define WP_ENV constant
- Remove babel support out of the box
- Update Laravel Elixir

## 3.1.0 (released 2016-01-22)

- Update to Laravel 5.2
- Update to Symfony 3.0
- Update to Elixir 4.0
- Update to Whoops 2.0
- Add .editorconfig file
- Fix bug where mail config is empty

## 3.0.2 (released 2015-09-25)

- Update description from config

## 3.0.1 (released 2015-09-22)

- Update permalink from config

## 3.0.0 (released 2015-09-08)

- Allow any ~4.0 WordPress version
- Code cleanup
- Don't install any plugins by default
- Dropped default pages support
- Made jjgrainger/wp-custom-post-type-class optional
- Made roots/soil optional
- Remove google analytics out of the box
- Update phpdotenv package

## 2.7.1 (released 2015-08-21)

- Remove clear command

## 2.7.0 (released 2015-08-20)

- Updated to WordPress 4.3
- Removed unused server page
- Removed the ability to hide updates
- Code cleanup

## 2.6.0 (released 2015-08-18)

- Added [Elixir](http://laravel.com/docs/elixir) Support ([#117](https://github.com/wordplate/wordplate/issues/117))

## 2.5.4 (released 2015-07-01)

- Sanitize File Name on Save ([#113](https://github.com/wordplate/wordplate/issues/113))

## 2.5.3 (released 2015-06-02)

- Fix Mail From and Name Bug ([#112](https://github.com/wordplate/wordplate/issues/112))

## 2.5.2 (released 2015-05-28)

- Added Charset and Language Attributes to Header ([#111](https://github.com/wordplate/wordplate/issues/111))
- Added wp_nav_menu to Header ([#108](https://github.com/wordplate/wordplate/issues/108))
- Fixed wp_title Category Bug ([#107](https://github.com/wordplate/wordplate/issues/107))

## 2.5.1 (released 2015-05-21)

- Remove Clear Command ([#105](https://github.com/wordplate/wordplate/issues/105))

## 2.5.0 (released 2015-05-21)

- Fix Permalink Update Method Bug ([#104](https://github.com/wordplate/wordplate/issues/104))
- Move Docs to Website ([#102](https://github.com/wordplate/wordplate/issues/102))
- Add Test Coverage ([#103](https://github.com/wordplate/wordplate/issues/103))
- Add Mail Configuration ([#100](https://github.com/wordplate/wordplate/issues/100))

## 2.4.0 (released 2015-05-10)

- Add post revisions to config ([#98](https://github.com/wordplate/wordplate/issues/98))
- Add IMAGE_EDIT_OVERWRITE ([#94](https://github.com/wordplate/wordplate/issues/94))
- Disable WordPress core updates ([#97](https://github.com/wordplate/wordplate/issues/97))
- Disable plugin and theme update and installation ([#95](https://github.com/wordplate/wordplate/issues/95))
- Make Whoops to handle all errors ([#93](https://github.com/wordplate/wordplate/issues/93))

## 2.3.0 (released 2015-05-03)

- Add plate console commander ([#92](https://github.com/wordplate/wordplate/issues/92))
- Add plate salts generator command ([#81](https://github.com/wordplate/wordplate/issues/81))
- Add new exception handler ([#91](https://github.com/wordplate/wordplate/issues/91))
- Add WP_HOME and WP_SITEURL ([#89](https://github.com/wordplate/wordplate/issues/89))
- Update Soil plugin to latest version ([#90](https://github.com/wordplate/wordplate/issues/90))
- Rename wp-content directory to public ([#88](https://github.com/wordplate/wordplate/issues/88))

## 2.2.0 (released 2015-04-26)

- Add theme color meta tag ([#84](https://github.com/wordplate/wordplate/issues/84))
- Add title tag theme support ([#83](https://github.com/wordplate/wordplate/issues/83))
- Add Windows support to post-create-project-cmd ([#82](https://github.com/wordplate/wordplate/issues/82))
- Add HTML5 tags theme support ([#77](https://github.com/wordplate/wordplate/issues/77))
- Update configuration files structure ([#79](https://github.com/wordplate/wordplate/issues/79))
- Update WordPress to version 4.2 ([#78](https://github.com/wordplate/wordplate/issues/78))
- Update header HTML ([#85](https://github.com/wordplate/wordplate/issues/85))
- Update @roots Soil plugin version ([#86](https://github.com/wordplate/wordplate/issues/86))
- Remove ACF simple editor toolbar ([#87](https://github.com/wordplate/wordplate/issues/87))

## 2.1.3 (released 2015-04-22)

- Fix template bug for pages ([#80](https://github.com/wordplate/wordplate/issues/80))

## 2.1.2 (released 2015-04-21)

- Fix infinite pages issue ([#76](https://github.com/wordplate/wordplate/issues/76))

## 2.1.1 (released 2015-04-21)

- Deregister jQuery by default ([#73](https://github.com/wordplate/wordplate/issues/73))
- Fix login image URL bug ([#74](https://github.com/wordplate/wordplate/issues/74))
- Fix infinite pages if the title key isn't available ([#75](https://github.com/wordplate/wordplate/issues/75))

## 2.1.0 (released 2015-04-19)

- Added default screenshot and favicon ([#71](https://github.com/wordplate/wordplate/issues/71))
- Added new directory structure ([#70](https://github.com/wordplate/wordplate/issues/70))
- Added default pages ([#67](https://github.com/wordplate/wordplate/issues/67))
- Added Google Analytics to configuration files ([#68](https://github.com/wordplate/wordplate/issues/68))
- Added plugin activation on theme switch ([#66](https://github.com/wordplate/wordplate/issues/66))

## 2.0.0 (released 2015-04-16)

- Rename the project to WordPlate
- Moved project to an organization
- Moved library to framework repository
- Added installer CLI tool
- Added theme activation on theme setup ([#56](https://github.com/wordplate/wordplate/issues/56))
- Added new installation guide
- Added changelog
- Update @roots soil plugin to the latest version

## 1.3.0 (released 2015-04-10)

- Added TinyPGN plugin ([#57](https://github.com/wordplate/wordplate/issues/57))
- Added @laravel's helper methods ([#63](https://github.com/wordplate/wordplate/issues/63))
- Added rename the home URL on theme setup ([#64](https://github.com/wordplate/wordplate/issues/64))

## 1.2.2 (released 2015-04-10)

- Added Whoops php errors for cool kids ([#62](https://github.com/wordplate/wordplate/issues/62))

## 1.2.1 (released 2015-04-10)

- Added configuration to disbale/enable updates

## 1.2.0 (released 2015-03-31)

- Added config helper method ([#61](https://github.com/wordplate/wordplate/issues/61))

## 1.1.1 (released 2015-03-27)

- Added WP Sweep plugin by @lesterchan ([#59](https://github.com/wordplate/wordplate/issues/59))

## 1.1.0 (released 2015-03-20)

- Added Dotenv environment package by @vlucas ([#44](https://github.com/wordplate/wordplate/issues/44))
- Added @roots Soil plugin ([#49](https://github.com/wordplate/wordplate/issues/49))
- Added Google Analytics ([#52](https://github.com/wordplate/wordplate/issues/52))

## 1.0.0 (released 2015-03-20)

- Move Boilerplate to Composer
- Added Server Settings page
- Added Custom Post Type class
- Added a boilerplate theme filled with actions and filters
- Added WordPress Packagist, WordPress plugins as packages
- Added plugins such as Advanced Custom Fields and WordPress Importer
