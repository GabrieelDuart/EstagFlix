#!/usr/bin/env bash

# author: Gabriel Chagas
# tested: Ubuntu 22.04 LTS

PROJETO="EstagFlix"
PROJECT_PATH="~/${PROJETO}"
USER="vagrant"
HOST="192.168.1.174"


case $1 in
  prod)
    echo "Executando em ambiente de produção."
    # Código para ambiente de produção
    ;;
  dev)
    echo "Executando em ambiente de desenvolvimento."
    # Código para ambiente de desenvolvimento
    ;;
  *)
    echo "Parâmetro inválido. Use 'prod' ou 'dev'."
    exit 1
    ;;
esac


ssh -t $USER@$HOST << EOF

cd $PROJECT_PATH
echo $1
bash pipeline/execution.sh 

EOF
