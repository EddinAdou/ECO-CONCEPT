
# Symfony Docker Setup

This repository contains a basic setup for running a Symfony application using Docker containers.

## Prerequisites

Make sure you have Docker and Docker Compose installed on your system.

- [Docker](https://docs.docker.com/get-docker/)
- [Docker Compose](https://docs.docker.com/compose/install/)

## Getting Started

1. Clone this repository:
   ```bash
   git clone <URL_DE_TON_REPO>
   ```

2. Navigate into the project directory:
   ```bash
   cd <NOM_DU_PROJET>
   ```

3. Install dependencies:
   ```bash
   docker compose build
   ```

4. Start the Docker containers:
   ```bash
   docker-compose up -d
   ```

5. Configure the `.env` file:
    - Follow the official [Symfony configuration guide](https://symfony.com/doc/current/configuration.html).

## Managing Docker Containers

- **Start the containers**:
  ```bash
  docker compose up -d
  ```

- **Stop the containers**:
  ```bash
  docker compose down
  ```

- **View logs**:
  ```bash
  docker compose logs
  ```

- **Access container for backend shell**:
  ```bash
  docker compose exec -it php-fpm bash
  ```

- **Access container for frontend shell**:
  ```bash
  docker compose exec -it frontend bash
  ```

- **Start a specific container shell**:
  ```bash
  docker start my_container
  ```

- **Start the backend container (Nginx)**:
  ```bash
  docker compose up -d nginx
  ```

- **Create the database**:
  ```bash
  php bin/console doctrine:database:create
  ```

- **Create a migration**:
  ```bash
  php bin/console make:migration
  ```

## Usage - Frontend

- Start the frontend:
  ```bash
  npm run start
  ```

## Testing

Instructions for running tests will go here.