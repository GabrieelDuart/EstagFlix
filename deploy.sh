#!/usr/bin/env bash

# author: Gabriel Chagas
# tested: Ubuntu 22.04 LTS
# Versão: 1.0

PROJETO="EstagFlix"
PROJECT_PATH="~/${PROJETO}"
USER="vagrant"
HOST="192.168.1.174"
DNS_HOST=prod-estagflix/


# =================================== CONEXÃO SSH =================================== #

ssh -t $USER@$HOST << EOF

# =================================== FUNÇÕES ====================================== #

err () {
  echo -e "\n\033[1;31mEtapa 1/3)\nERRO! \033[0m\n"
  echo \$1
  exit 1
}

checks_docker () {
  if ! command -v docker &> /dev/null; then
    curl -fsSL https://get.docker.com -o get-docker.sh &> /dev/null || err "checks_docker"
    sudo sh get-docker.sh &> /dev/null || err "checks_docker"
    sudo apt update &> /dev/null || err "checks_docker"
    apt install docker-compose -y &> /dev/null || err "checks_docker"
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
    git checkout main &> /dev/null
    git pull &> /dev/null
    echo "Projeto OK ✅"
  fi
}

# =================================== EXECUÇÃO ====================================== #

echo -e "\n\033[1;31mEtapa 1/3 - Verificando requisitos para Deploy do $PROJETO \033[0m\n"

checks_git
check_or_clone_project
checks_docker 

echo -e "\n\033[1;31mEtapa 2/3 - Build do projeto \033[0m\n"

cd $PROJECT_PATH
docker-compose build &> /dev/null && echo "Build ✅"

echo -e "\n\033[1;31mEtapa 3/3 - Deploy \033[0m\n"

docker-compose down --remove-orphans &> /dev/null || err "compose down"
docker-compose up -d &> /dev/null || err "compose up"
echo "Deploy OK ✅"

echo -e "\n\033[1;32mLink para acesso: 'http://prod-estagflix/'\033[0m\n"

EOF
