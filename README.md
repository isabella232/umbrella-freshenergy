## Setup instructions

This repository is designed to be set up in accordance with INN's site setup instructions in https://github.com/INN/docs/blob/master/projects/largo/umbrella-setup.md, and deployed via [WP Engine Git push](https://github.com/INN/docs/blob/master/how-we-work/dev-processes/setup-wpengine-gitpush.md)
```
vv create
```

Prompt | Text to enter 
------------ | -------------
Name of new site directory: | freshenergy
Domain to use (leave blank for largo-umbrella.dev): | freshenergy.test
Install as multisite? (y/N): | **Y**
Install as subdomain or subdirectory? : | subdomain

## Initial database setup notes

This is a series of notes of what had to be done to get the db working.

1. `fab vagrant.reload_db:freshenergydb_dev__2016-09-19__3-21\ PM.sql,freshenergy`
2. open `wp-config.php`, disable all multisite lines
3. `wp user` command to update our user with the password from 1pass
4. in Sequel Pro, change the site's domain and home in `wp_options` to http://freshenergy.dev/
4. Follow instructions on https://codex.wordpress.org/Create_A_Network to convert the singlesite database to a multisite database, including progressively enabling the lines in `wp-config.php`
5. Perform database replacements:
	- in `wp_blogs`, set domain to `freshenergy.wpengine.com`
	- in `wp_site`, set domain to `freshenergy.wpengine.com`
	- in `wp_options`, set siteurl and home to `http://freshenergy.wpengine.com/`
	- in `wp_sitemeta`, set siteurl and home to `http://freshenergy.wpengine.com/`
5. Get WPE to upload the DB
6. Log into the network admin, and do the following:
	- Network Enable the Largo base theme
	- enable the Fresh Energy theme for the Fresh Energy site
7. Go to the Fresh Energy dashboard
	- Activate the Fresh Energy theme that's a Largo child
	- In Settings > Reading, change "Front page displays" to "Your latest posts"

## Theme setup notes for freshenergy

Widgets:

- Homepage Call to Action
	- Text widget
- Homepage Circles Menu
	- Custom Menu, set to use the Circles Menu
- Homepage Bottom
	- Fresh Energy Homepage Widgets
- Homepage Footer
	- donation acceptance widget
	- newsletter signup widget

Theme Options

- Layout
	- Home Template: Fresh Energy Homepage Template
	- Homepage Bottom: blank
	- Show Sticky Posts? : unchecked
