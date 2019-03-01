#!/usr/bin/env bash

if [[ "$#" -eq 1 ]]; then
    cd php
    php image-processing.php
    cd ../

    cd java
    javac ImageProcessing.java
    java ImageProcessing
    cd ../

    cd python
    python image-processing.py
    cd ../

    cd golang
    go build image-processing.go
    go image-processing
    cd ../

else
    for var in "$@"
    do
        case $var in
        "php")
            cd php
            php image-processing.php
            cd ../
        ;;
        "java")
            cd java
            javac ImageProcessing.java
            java ImageProcessing
            cd ../
        ;;
        "python")
            cd python
            echo var
            python image-processing.py
            cd ../
        ;;
        "golang" | "go")
            cd golang
            go build image-processing.go
            go image-processing
            cd ../
        ;;
        *)

        ;;
        esac
    done
fi
