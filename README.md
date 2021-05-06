# BackendAcademy2021
Lessons 10 - 12 for SofaScore backend academy 2021

# Introduction
This repo contains a demo Symfony project and lessons for SofaScore backend academy 2021, as well as some extras which can improve your development experience. Please clone this repo to your computer and follow the steps bellow.

## Symfony Project
The project is virtualized using Docker. The Docker image has 4 relevant services: PHP-FPM, PostgreSQL, Redis and nginx.

### Installing Docker
1. Download Docker Desktop from this page: https://www.docker.com/get-started
2. Run the file and install it using your desired configuration (or just use default)
3. Windows only step:
    1. To be able to utilize Docker, you will need a virtualization "platform". There are two options: Windows Subsystem for Linux (WSL 2) or HyperV. WSL2 is a newer and more performant, but a bit more complicated to install. We recommend using HyperV while it still works (it will be deprecated in the future) for this demo project since we don't need to extract every ounce of performance and HyperV should take less disk space. If you don't have a Windows version which has HyperV, then just use WSL. Both will work fine.
        1. Installing HyperV:
            1. Open Start and type "Windows features", click on the first search result.
            2. Find HyperV and enable it if it had been disabled, restart the system if necessary. If you don't have HyperV among the options, use WSL.
            3. Run Docker -> right click on the taskbar icon -> settings -> uncheck "Use the WSL 2 based engine"
        2. Installing WSL 2
            1. If you do not have WSL 2 installed and enabled, Docker will show a warning message "WSL 2 installation is incomplete". The message has a link in it, follow the detailed steps described there. Pick alpine linux distro.

### Starting Docker and testing if everything works fine
Notes:
1. Background on some of there steps can be found in README.html in phpdocker directory of this project.
2. If some commands don't work as `docker compose`, try using `docker-compose`. On newer Docker versions they are the same, but `docker-compose` is the old version of the command.
3. This docker compose config was created using https://phpdocker.io/generator and the project is Symfony website skeleton https://symfony.com/doc/current/setup.html. Some changes were made to `docker-compose.yml` file to make sure everything is working properly. In 2020, tests wouldn't work if directory mapping wasn't changed from default to that in 6th point of the next list.

Actual steps:
1. Position yourself in main directory of this git repository in your preferred command line terminal.
2. Run `docker compose up`. It will run contineous Docker process in the foreground of this terminal, meaning you will have to open a new terminal instance to do other things. If you add `-d`, Docker will run in background. It is recommended that for the first time, you run in the foreground to see if any warnings show up.
3. Docker will start, download some archives and ask for some permissions for file system mapping. Allow anything it asks for.
4. If you ran Docker in the foreground, open new terminal and position in the same directory. Otherwise, use the current instance.
5. Run `docker compose exec php-fpm bash`. The command will shell you inside PHP-FPM service's bash terminal and we will run most of the stuff here.
6. There is a pre-configured Symfony project here in `academy` directory which Docker maps to `/var/www/academy` in our containers. Therefore, run `cd /var/www/academy` to position in the mapped directory.
7. Run `bin/console doctrine:schema:update --dump-sql` for Doctrine to check ORM schema sync with DB. If you see some SQL, everything works fine.
8. Open `http://localhost:8765/` in your browser. You should see the default Symfony page.

## Lessons 