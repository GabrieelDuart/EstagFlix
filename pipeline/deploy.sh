#!/usr/bin/env bash

# author: Gabriel Chagas
# tested: Ubuntu 22.04 LTS

###### Variaveis ######

PROJETO="EstagFlix"
PROJECT_PATH="~/${PROJETO}"
USER="vagrant"
HOST="192.168.1.174"

###### Funções ########

function checks_docker () {
  if ! command -v docker &> /dev/null; then
    curl -fsSL https://get.docker.com -o get-docker.sh && sudo sh get-docker.sh
    sudo apt update && apt install docker-compose -y 
  else
    echo "Docker OK ✅"
  fi
}

function checks_docker_compose () {
  if ! command -v docker-compose &> /dev/null; then
    sudo apt update && apt install docker-compose -y 
  else
    echo "Docker Compose OK ✅"
  fi
}


function checks_git (){
  if ! command -v git &> /dev/null; then
    sudo apt update && sudo apt install git && echo "git OK"
  else
    echo "Git OK ✅"
  fi
  
}

function checks_project(){
    if [ ! -d ${PROJECT_PATH} ]; then
        echo -e "Projeto não encontrado na home do usuario ❌\n"
        git clone git@github.com:GabrieelDuart/EstagFlix.git
    if ! [ \$? -eq "0" ]; then
        if [ -d ~/.ssh ]; then
            cat ~/.ssh/id_rsa.pub && echo -e "\nColoque a SSH KEY acima no Github e rode o script novamente\n && exit 0"
        else
            ssh-keygen -q -t rsa -N '' -f ~/.ssh/id_rsa && cat ~/.ssh/id_rsa.pub && echo -e "\nColoque a SSH KEY acima no Github e rode o script novamente\n" && exit 0
        fi
    fi
    else
        cd /home/vagrant/EstagFlix
        git fetch || exit 1
        git checkout chagas &> /dev/null  || exit 1
        git pull &> /dev/null || exit 1
        echo "Projeto OK ✅"
    fi
}

ssh -t -o ConnectTimeout=6000 $USER@$HOST << EOF


    $(declare -f checks_docker)
    $(declare -f checks_docker_compose)
    $(declare -f checks_project)
    $(declare -f checks_git)

    echo -e "\n\033[1;31mEtapa 1)\nVerificando requisitos para Deploy do $PROJETO \033[0m\n"

    checks_docker
    checks_docker_compose
    checks_git
    checks_project

    echo -e "\n\033[1;31mEtapa 1)\nBuild da Imagem \033[0m\n"

    cd $PROJECT_PATH
    #docker-compose down --remove-orphans &> /dev/null
    #docker-compose build &> /dev/null
    #ENV=-dev WEB_PORT=5000 MYSQL_PORT=4000 docker-compose up -d &> /dev/null

    docker-compose ps -q | xargs docker inspect --format '{{.Name}}' | cut -c2- | awk '{print \$0 "\t'http://$HOST':5000"}' | column -t


EOF

#ip_vagrant=$(ip addr show wlp2s0 | grep -Po 'inet \K[\d.]+')

#ip_vagrant=$(ip addr show eth1 | grep -Po 'inet \K[\d.]+')

echo $potoco