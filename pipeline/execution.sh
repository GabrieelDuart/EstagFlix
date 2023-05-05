#!/usr/bin/env bash

# FUNCTIONS

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

checks_project(){
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
        cd $PROJECT_PATH
        git checkout chagas
        git pull &> /dev/null
        echo "Projeto OK ✅"
    fi
}

checks_docker
checks_git
checks_project