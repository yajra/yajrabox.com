#!/bin/bash

DATATABLES=(
  master
  9.0
  8.0
  7.0
  6.0
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

ACL=(
  master
  9.0
  5.0
  4.0
  3.0
)

for v in "${ACL[@]}"; do
    if [ -d "resources/docs/laravel-acl/$v" ]; then
        echo "Pulling latest documentation updates for $v..."
        (cd resources/docs/laravel-acl/$v && git pull)
    else
        echo "Cloning $v..."
        git clone --single-branch --branch "$v" git@github.com:yajra/laravel-acl-docs.git "resources/docs/laravel-acl/$v"
    fi;
done