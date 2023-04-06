<br />
<br />
<p align="center">
  <!-- XMAS: https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg-->
<img width="589" src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" alt="Laravel">
</p>
<br />

<h3 align="center"><a href="https://dentatic.com" target="_blank">Dentatic</a> Laravel boilerplate</h3>

  <p align="center">
  Modified <a href="https://laravel.com" target="_blank">Laravel</a> application with DDD structure and additional packages installed and configured, to help you start building your next big application.
</p>

# Requirements

-   PHP ^8.1
-   Composer ^2.0

# Installation

Clone the project

```bash
  git clone {repository link} app-name
```

Go to the project directory

```bash
  cd app-name
```

Checkout `main` branch

```bash
  git checkout main
```

Install dependencies

```bash
  composer install
```

Setup .env file

-   Laravel Sail

```bash
  cp .env.sail .env
```

-   Local development environment:

```bash
  cp .env.example .env
```

Generate application key

```bash
  php artisan key:generate
```

Generate passport

```bash
  php artisan passport:install
```

Generate storage

```bash
  php artisan storage:link
```

create DB and seed

```bash
  php artisan migrate --seed
```

Tests User

```bash
  email: admin@test.com
  pass: password
```

## Run with Laravel Sail

If you are new to docker, it is not a problem because using [**Laravel Sail**](https://laravel.com/docs/9.x/sail#introduction) we don't have to go deeply into docker.
All you need to know about **Sail** is mentioned in the [Laravel installation instructions using sail](https://laravel.com/docs/9.x/installation#laravel-and-docker) and the [Sail documentation](https://laravel.com/docs/9.x/sail#).

-   Docker installation:

    -   **Windows**: you can follow this [tutorial](https://www.youtube.com/watch?v=rr6AngDpgnM) to learn how run Laravel project using Sail. and in case you want to run multiple Laravel projects at the same time, you can also watch this [tutorial](https://www.youtube.com/watch?v=N3uVU7To2Bc) (note that there is a written version of these tutorials you can find it in the videos description).
    -   **Linux**: you can read these [instructions](https://docs.docker.com/engine/install/ubuntu/) for installing the docker. and in case you want to run multiple Laravel projects at the same time, you can use the same windows instructions mentioned in this [tutorial](https://www.youtube.com/watch?v=N3uVU7To2Bc).

-   Sail basic commands:

    -   Start the containers:

        ```bash
        ./vendor/bin/sail up -d
        ```

    -   Open sail shell:

        ```bash
        ./vendor/bin/sail shell
        ```

    -   Stop the containers:

        ```bash
        ./vendor/bin/sail stop
        ```

    -   Stop the containers and remove them:

        ```bash
        ./vendor/bin/sail down
        ```

    -   Stop the containers and remove them and delete volumes:
        ```bash
        ./vendor/bin/sail down -v
        ```

-   Notes:

    -   when working with Laravel Sail it is important to use [aliases](#aliases) to speed up your work.

    -   your daily routine will only use `sail up -d` and `sail stop` but if you faced a problem you may need `sail down -v` and then start your containers again.

    -   we defined only the `mysql`, `redis`, and `mailhog` images in the `docker-compose.yml` file because they are the most used, you can modify the images based on your project requirements.

    -   after setting up every thing you can run `{php or sail} artisan migrate --seed` and `(php or sail) artisan passport:install`.

## Run Locally

You can use your typical development environment but it is recommended to use [Laravel Sail](https://laravel.com/docs/9.x/sail#introduction).

-   Start local development server:

    ```bash
    php artisan serve
    ```
