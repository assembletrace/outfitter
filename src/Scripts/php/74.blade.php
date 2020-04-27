# Install PHP 7.4
sudo add-apt-repository -y ppa:ondrej/php

sudo apt-get update

sudo apt-get install -y php7.4-{fpm,cli,sqlite3,mysql,gd,imagick,curl,bcmath,imap,mbstring,xml,zip,intl,readline,json,opcache}