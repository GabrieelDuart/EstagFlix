#!/bin/bash

echo "Iniciando operação"

echo -n "Aguarde"
for i in {1..3}; do
    echo -n "."
    sleep 1
done
echo ""

echo "Operação concluída"