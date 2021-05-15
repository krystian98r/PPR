#!/bin/bash

host="127.0.0.1";
port=1235;

lsof -i tcp:${port} | awk 'NR!=1 {print $2}' | xargs kill  -9 >/dev/null
lsof -i udp:${port} | awk 'NR!=1 {print $2}' | xargs kill  -9 >/dev/null
konsole -e php -S ${host}:${port} proc3.php &

port=1234;

sudo fuser -k ${port}/tcp >/dev/null
konsole -e php -S ${host}:${port} proc2.php &

dotnet run

