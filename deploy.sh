#!/usr/bin/env bash

path="~/EstagFlix"




ssh user@192.168.1.145 << EOF

#checks docker
if ! command -v docker &> /dev/null; then
  curl -fsSL https://get.docker.com -o get-docker.sh && sudo sh get-docker.sh 
else
  echo "Docker OK"
fi

#checks git
if ! command -v git &> /dev/null; then
  sudo apt install git && echo "git OK"
else
  echo "Git OK"
fi

#cd $path
#docker-compose down --remove-orphans
#git pull
#docker-compose build && docker-compose up -d

EOF
