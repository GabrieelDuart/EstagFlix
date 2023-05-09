#!/usr/bin/env bash

# author: Gabriel Chagas
# tested: Ubuntu 22.04 LTS

PROJETO="EstagFlix"
PROJECT_PATH="~/${PROJETO}"
USER="vagrant"
HOST="192.168.1.174"


# =================================== CONEXÃO SSH =================================== #

ssh -t $USER@$HOST << EOF

# =================================== FUNÇÕES ====================================== #

checks_docker () {
  if ! command -v docker &> /dev/null; then
    curl -fsSL https://get.docker.com -o get-docker.sh && sudo sh get-docker.sh
    sudo apt update && apt install docker-compose -y 
  else
    echo "Docker OK ✅"
  fi

}

checks_git (){
  if ! command -v git &> /dev/null; then
    sudo apt update && sudo apt install git && echo "git OK"
  else
    echo "Git OK ✅"
  fi
  
}

check_or_clone_project() {
  if [ ! -d ${PROJECT_PATH} ]; then
    echo -e "Projeto não encontrado na home do usuário ❌\n"
    git clone git@github.com:GabrieelDuart/EstagFlix.git

    if ! [ $? -eq "0" ]; then
      if [ -d ~/.ssh ]; then
        cat ~/.ssh/id_rsa.pub && echo -e "\nColoque a SSH KEY acima no Github e rode o script novamente\n" && exit 0
      else
        ssh-keygen -q -t rsa -N '' -f ~/.ssh/id_rsa && cat ~/.ssh/id_rsa.pub && echo -e "\nColoque a SSH KEY acima no Github e rode o script novamente\n" && exit 0
      fi
    fi
  else
    cd $PROJECT_PATH
    git checkout chagas &> /dev/null
    git pull &> /dev/null
    echo "Projeto OK ✅"
  fi
}

# =================================== EXECUÇÃO ====================================== #

echo -e "\n\033[1;31mEtapa 1)\nVerificando requisitos para Deploy do $PROJETO \033[0m\n"

checks_git
check_or_clone_project
checks_docker 



echo -e "\n\033[1;31mEtapa 2)\nBuild do projeto \033[0m\n"

cd $PROJECT_PATH
docker-compose down --remove-orphans && docker-compose build
ENV=-dev WEB_PORT=5000 MYSQL_PORT=4000 docker-compose up -d


EOF
