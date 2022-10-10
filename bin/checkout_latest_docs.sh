#!/bin/bash

DATATABLES=(
  master
  9.0
)

for v in "${DATATABLES[@]}"; do
    if [ -d "resources/docs/laravel-datatables/$v" ]; then
        echo "Pulling latest documentation updates for $v..."
        (cd resources/docs/laravel-datatables/$v && git pull)
    else
        echo "Cloning $v..."
        git clone --single-branch --branch "$v" git@github.com:yajra/laravel-datatables-docs.git "resources/docs/laravel-datatables/$v"
    fi;
done
