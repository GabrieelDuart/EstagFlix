#!/usr/bin/env bash

# author: Gabriel Chagas
# tested: Ubuntu 22.04 LTS
# Versão: 1.0

PROJETO="EstagFlix"
PROJECT_PATH="~/${PROJETO}"
USER_SSH="vagrant"
HOST="192.168.1.140"
DNS_HOST=prod-estagflix/
err_command="err"


# =================================== CONEXÃO SSH =================================== #

ssh -t $USER_SSH@$HOST << EOF

# =================================== FUNÇÕES ====================================== #

err() {
  while read stderr; do
    echo -e "\n\e[1m\e[31mErro!!!\e[0m\n" >&2
    echo -e "\e[1mDescrição do erro:\n\e[0m\n\e[1m\$stderr\e[0m" >&2
    exit 1
  done
}

checks_docker () {
  if ! command -v docker &> /dev/null; then
    curl -fsSL https://get.docker.com -o get-docker.sh > /dev/null
    sudo sh get-docker.sh > /dev/null
    sudo apt update > /dev/null
  else
    sudo groupadd docker &> /dev/null
    sudo usermod -aG docker $USER_SSH &> /dev/null
    echo "Docker OK ✅"
  fi

}

checks_docker-compose () {
  if ! command -v docker-compose &> /dev/null; then
    sudo apt update > /dev/null
    sudo apt install docker-compose -y &> /dev/null
  else
    echo "Docker Compose OK ✅"
  fi
}

checks_git (){
  if ! command -v git &> /dev/null; then
    sudo apt update && sudo apt install git && echo "Git OK ✅"
  else
    echo "Git OK ✅"
  fi
  
}

check_or_clone_project() {
  if [ ! -d ${PROJECT_PATH} ]; then
    echo -e "Projeto não encontrado na home do usuário ❌\n"
    ssh-keygen -F github.com || ssh-keyscan github.com >> ~/.ssh/known_hosts
    git clone git@github.com:GabrieelDuart/EstagFlix.git &> /dev/null || cat ~/.ssh/id_rsa.pub 2> /dev/null && echo -e "\nColoque a SSH KEY acima no Github e rode o script novamente\n" && exit 0 || ssh-keygen -q -t rsa -N '' -f ~/.ssh/id_rsa && cat ~/.ssh/id_rsa.pub && echo -e "\nColoque a SSH KEY acima no Github e rode o script novamente\n" && exit 0
  else
    echo "Projeto OK ✅"
  fi
}

# =================================== EXECUÇÃO ====================================== #

echo -e "\n\033[1;31mEtapa 1/3 - Verificando requisitos para Deploy do $PROJETO \033[0m\n"


checks_git
check_or_clone_project
checks_docker 
checks_docker-compose

echo -e "\n\033[1;31mEtapa 2/3 - Build do projeto \033[0m\n"

cd $PROJECT_PATH
git checkout chagas &> /dev/null
ssh-add ~/.ssh/id_rsa &> /dev/null
git pull 1> /dev/null
sudo docker-compose build &> /dev/null
echo "Build ✅"

echo -e "\n\033[1;31mEtapa 3/3 - Deploy \033[0m\n"

sudo docker-compose down --remove-orphans &> /dev/null
echo "Deploy OK ✅"

echo -e "\n\033[1;32mLink para acesso: 'http://prod-estagflix/'\033[0m\n"

EOF