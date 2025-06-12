# WP Starter Theme - 2024 Task Force version
While this template is ready to be used, it is not complete by any means. It is designed to be a much more bare template to start WP projects from. Please report any issues, suggestions, and questions via [Issues](https://github.com/fjorgedigital/task-force--wp-starter-theme/issues), [Pull Request](https://github.com/fjorgedigital/task-force--wp-starter-theme/pulls), or slack message to Brianna. 

## First Time Startup
- make sure you're running the node version from the .lando.yml file `nvm run 20`
- in .lando.yml file, update "name" value. This will prepend ".lndo.site" for your local URL. 
- `lando start`
- From webroot defined in .lando.yml ("wordpress" by default), download the rest of the WP files that are gitignored:
  - `lando wp core download --skip-content`
- Go to the lando URL in your browser (default is https://wp-starter-theme.lndo.site/) and follow the WP install steps. _It will create your local wp-config file for you if you don't have one already_
  - run `lando info` to find the correct values for database name, user, password, and host. You'll find those values in the object with the service "database". The "healthcheck" key has all 4 values.
- **_activate ACF Plugin to avoid critical error_**
- In the theme directory (`cd wordpress/wp-content/themes/wp-starter-theme/`):
  - Run `npm install`
  - Run `gulp`
