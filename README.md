# promoqui.test

tested on linux ubuntu

download repository

create symolic link ln -s utils/dc.sh dc

build docker ./dc build

up docker ./dc up -d

run query from utils/db.sql

call http://localhost:8080/?node_id=7&language=italian

enjoy
