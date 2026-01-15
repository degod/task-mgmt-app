# INTRODUCTION

A simple Laravel web application for task management. It can be used for simple stuffs such as:

- Create task (info to save: task name, priority, timestamps)
- Edit task
- Delete task
- Reorder tasks with drag and drop in the browser. Priority should automatically be updated based on this. #1 priority goes at top, #2 next down and so on.

Tasks are saved to a mysql table.

NOTE: An added project functionality to the tasks. User are be able to create and select a project from a dropdown and only view tasks associated with that project.

## PRE-REQUISITE FOR SETUP

- Docker daemon (docker desktop)
- Web browser (to simulate in UI)
- Terminal (git bash)

## HOW TO SETUP

- Make sure your docker desktop is up and running
- Launch you terminal and navigate to your working directory

```bash
cd ./working_dir
```

- Clone repository

```bash
git clone https://github.com/degod/task-mgmt-app.git
```

- Move into the project directory

```bash
cd task-mgmt-app/
```

- Copy env.example into .env

```bash
cp .env.example .env
```

- Build app using docker

```bash
docker compose up -d --build
```

-   Log in to docker container bash

```bash
docker compose exec app bash
```

-   Install composer

```bash
composer install
```

-   Create an application key

```bash
php artisan key:generate
```

-   Run database migration and seeder

```bash
php artisan migrate:fresh --seed
```

-   Run automated unit/feature test for backend

```bash
composer test
```

-   Exit docker container bash

```bash
exit
```

## ACCESSING THE APPLICATION UI AND DATABASE

- To access UI for simulation, visit
  `http://localhost:5020/`

- To access application's database, visit
  `http://localhost:5021`

