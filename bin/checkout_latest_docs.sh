#!/bin/bash

DATATABLES=(
  master
  10.0
  9.0
  8.0
  7.0
  6.0
)

for v in "${DATATABLES[@]}"; do
    if [ -d "resources/docs/laravel-datatables/$v" ]; then
        echo "Pulling latest laravel-datatables documentation updates for $v..."
        (cd resources/docs/laravel-datatables/$v && git pull)
    else
        echo "Cloning $v..."
        git clone --single-branch --branch "$v" https://github.com/yajra/laravel-datatables-docs "resources/docs/laravel-datatables/$v"
    fi;
done

ACL=(
  master
  10.0
  9.0
  5.0
  6.0
  4.0
  3.0
)

for v in "${ACL[@]}"; do
    if [ -d "resources/docs/laravel-acl/$v" ]; then
        echo "Pulling latest laravel-acl documentation updates for $v..."
        (cd resources/docs/laravel-acl/$v && git pull)
    else
        echo "Cloning $v..."
        git clone --single-branch --branch "$v" https://github.com/yajra/laravel-acl-docs "resources/docs/laravel-acl/$v"
    fi;
done

OCI8=(
  master
  10.0
  9.0
  8.0
  7.0
  6.0
  5.3
)

for v in "${OCI8[@]}"; do
    if [ -d "resources/docs/laravel-oci8/$v" ]; then
        echo "Pulling latest laravel-oci8 documentation updates for $v..."
        (cd resources/docs/laravel-oci8/$v && git pull)
    else
        echo "Cloning $v..."
        git clone --single-branch --branch "$v" https://github.com/yajra/laravel-oci8-docs "resources/docs/laravel-oci8/$v"
    fi;
done

AUDITABLE=(
  master
  4.0
  3.0
  2.0
)

for v in "${AUDITABLE[@]}"; do
    if [ -d "resources/docs/laravel-auditable/$v" ]; then
        echo "Pulling latest laravel-auditable documentation updates for $v..."
        (cd resources/docs/laravel-auditable/$v && git pull)
    else
        echo "Cloning $v..."
        git clone --single-branch --branch "$v" https://github.com/yajra/laravel-auditable-docs "resources/docs/laravel-auditable/$v"
    fi;
done
