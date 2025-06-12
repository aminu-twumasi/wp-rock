#!/bin/bash

# $PROJECT should be identical to that defined when setting up build pipeline
PHP_VERSION=8.3
PROJECT={{ PLACEHOLDER }}

if [ "$DEPLOYMENT_GROUP_NAME" = "${PROJECT}-production" ]
then
    site_path="/var/www/vhosts/{{ PLACEHOLDER }}/httpdocs"
    site_user={{ PLACEHOLDER }}
fi
if [ "$DEPLOYMENT_GROUP_NAME" = "${PROJECT}-maintenance" ]
then
    site_path="/var/www/vhosts/m02.project-qa.com/{{ PLACEHOLDER }}"
    site_user="maintainer"
fi
if [ "$DEPLOYMENT_GROUP_NAME" = "${PROJECT}-staging" ]
then
        site_path="/var/www/vhosts/l06.project-qa.com/{{ PLACEHOLDER }}"
    site_user="project-qa"
fi
if [ "$DEPLOYMENT_GROUP_NAME" = "${PROJECT}-develop" ]
then
    site_path="/var/www/vhosts/l06.project-qa.com/{{ PLACEHOLDER }}"
    site_user="project-qa"
fi

# Run WP database migrations as site user
cd $site_path
if [ -f ./env.php ] # so as not to break initial deploys where DB connection is not configured yet
then
    sudo -u $site_user /opt/plesk/php/$PHP_VERSION/bin/php /usr/local/bin/wp core update-db
fi
