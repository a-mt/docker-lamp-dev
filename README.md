# Docker LAMP

Installs a simple Lamp project.

## Create a local SSL certificate

- Download [mkcert](https://github.com/FiloSottile/mkcert)
- `mkcert -install`
- `mkcert yoursite`
- `mv yoursite.pem yoursite-key.pem ./www`

If you don't name your site `yoursite` (most likely), change the path of the pem files in `etc/apache2/hosts.conf`.

## Run

    # Give ownership to www-data
    # (we set the UID of www-data to 1000 in the Dockerfile)
    sudo chown -R $(whoami):1000 ./www

  	# Make sure Docker is running
  	sudo docker ps
  
  	# Run docker-compose
  	sudo docker-compose up -d
  
## Access the site

- Edit `/etc/hosts` with admin privileges
- Add `127.0.0.1 yoursite`
- Open your browser and go to `http://yoursite` or `https://yoursite`

## Define your environment variables

### During dev

In the `www/.env.ini` file (loaded in `inc.config.php`)

    DEBUG=true
    DOMAIN='yoursite'

### During prod

In the `docker-compose.yml` file

    services:
      webserver:
        ...
        environment:
          - DEBUG=0
          - DOMAIN=yoursite

## Stop the containers

    sudo docker stop $(sudo docker ps -a -q)
    sudo docker rm $(sudo docker ps -a -q)
