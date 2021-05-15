#!/bin/bash

host="127.0.0.1";
port=1234;

sudo fuser -k ${port}/tcp
php -S ${host}:${port} server.php
