# BackendAcademy2021
Lessons 10 - 12 for SofaScore backend academy 2021

# Introduction
This repo contains a demo Symfony project and lessons for SofaScore backend academy 2021, as well as some extras which can improve your development experience. Please clone this repo to your computer and follow the steps bellow.

## Symfony Project
The project is virtualized using Docker. The Docker image has 4 relevant services: PHP-FPM, PostgreSQL, Redis and nginx.

### Installing Docker
1. Download Docker Desktop from this page: https://www.docker.com/get-started
2. Run the file and install it using preffered configuration
3. Windows only step:
    1. To be able to utilize Docker, you will need a virtualization "platform". There are two options: Windows Subsystem for Linux (WSL, WSL2) or HyperV. WSL is a newer and more performant, but a bit more complicated to install. We recommend using HyperV while it still works (it will be deprecated in the future) for this demo project since we don't need to extract every ounce of performance and HyperV should take a little less disk space. If you don't have a Windows version which has HyperV, then just use WSL. Both will work fine.
        1. Installing HyperV:
            1. Open start and type "Windows features", click on the first search result.
            2. Find HyperV and enable it if it had been disabled, restart the system if necessary. If you don't have HyperV among the options, use WSL.
            3. Run Docker -> right click on the taskbar icon -> settings -> uncheck "Use the WSL 2 based engine"
        2. Installing WSL
            1. If you do not have WSL installed and enabled, Docker will show a warning message "WSL 2 installation is incomplete". The message has a link in it, follow the detailed steps described there.
4. Position yourself in the project directory in your preffered command line terminal. 

## Lessons 