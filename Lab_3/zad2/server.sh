#!/bin/bash

host="127.0.0.1";
port=12345;

lsof -i tcp:${port} | awk 'NR!=1 {print $2}' | xargs kill  -9
php -S ${host}:${port} server_1.php
