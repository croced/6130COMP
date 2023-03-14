#!/bin/bash

sudo docker build . -t backend-image -f base-images/backend/server/Dockerfile \

echo "********* Init build exited! **********"