#!/bin/bash

sudo apt-get install apt-transport-https
sudo apt-get update
sudo apt-get install aspnetcore-runtime-2.1
sudo apt-get install dotnet-sdk-2.1
dotnet tool install --global dotnet-svcutil
