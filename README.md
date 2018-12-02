# Docker LAMP

Installs Lamp project for local development

* Handles multiple domains (`localhost`, `yoursite`)
* Handles http and https
* phpmyadmin is accessible via `/phpmyadmin/` (with a trailing /)

## Install

### Create a local SSL certificate

- Download [mkcert](https://github.com/FiloSottile/mkcert)
- Run `mkcert -install` so that your browser accepts mkcert certificates
- Create a certificate and private key for your website:

        mkcert yoursite
        mv yoursite.pem ./www/yoursite/site.crt
        mv yoursite-key.pem ./www/yoursite/site.key

### Set your the database password

Change the name of the database and user to be created in `docker-compose.yml`

      - MYSQL_ROOT_PASSWORD=rootpassword
      - MYSQL_DATABASE=mydatabase
      - MYSQL_USER=myuser
      - MYSQL_PASSWORD=userpassword

### Set the app environment variables

In the `www/yoursite/.env.ini` file (loaded in `inc.config.php`)

    ; Fichier de configuration chargé dans inc.config.php
    
    DEBUG=true
    DOMAIN='yoursite'
    
    [database]
    DB_DSN='mysql:dbname=mydatabase;host=db'
    DB_USER='myuser'
    DB_PASSWORD='userpassword'

Or in the `docker-compose.yml` file

    services:
      webserver:
        ...
        environment:
          - DEBUG=0
          - DOMAIN=yoursite

## Run

Give ownership to www-data
(we set the UID of www-data to 1000 in the Dockerfile):

    sudo chown -R $(whoami):1000 ./www

Make sure Docker is running

  	sudo docker ps

Run the container

  	sudo docker-compose up -d

If you change the Dockerfile and you need to rebuild the image, use `sudo docker-compose build` instead

## Access the site

- Edit `/etc/hosts` with admin privileges and add `127.0.0.1 yoursite`
- Check accessing the websites works: `http://localhost`, `http://yoursite`
- Check your SSL certificate is correctly configured: `https://yoursite`
- Check you can access the database: `https://yoursite/test`
- Access phpmyadmin: `https://yoursite/phpmyadmin/`

## Others

Stop the containers

    sudo docker stop $(sudo docker ps -a -q)
    sudo docker rm $(sudo docker ps -a -q)

Execute a command on a running container

    sudo docker ps
    sudo docker exec -it CONTAINER_ID ls /

Ressources that have been useful:  
[@PerchCMS/simple-docker](https://github.com/PerchCMS/simple-docker)  
[@sprintcube/docker-compose-lamp](https://github.com/sprintcube/docker-compose-lamp/blob/master/bin/webserver/Dockerfile)  
[@mattrayner/docker-lamp](https://github.com/mattrayner/docker-lamp/blob/master/1604/Dockerfile-php7)  
[@phpmyadmin/docker](https://github.com/phpmyadmin/docker/blob/master/Dockerfile)