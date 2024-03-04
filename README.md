# Task Manager    
### 📝 Task manager is a web application to create tasks. When you create, update or when the deadline date of each task is close, you receive a e-mail. 
<img src="home.png" alt="super-gestao">

## 🛠️ Made with Laravel, Composer, NPM, PHP, Postgres, MailPit and Docker

## What you need to use TaskManager:

- Docker
- Docker Compose
- Git

## Initial Configuration 🚀

1. Clone this repository
   
```bash
    git clone https://github.com/WillianMafra/Super-Gestao.git
```

2. Access the project directory.

``` bash
    cd Super-Gestao
```

3. Install Composer dependencies.

```docker
    docker run --rm \
        -u "$(id -u):$(id -g)" \
        -v "$(pwd):/var/www/html" \
        -w /var/www/html \
        laravelsail/php83-composer:latest \
        composer install --ignore-platform-reqs
```
4. Create an alias to simplify using Sail.

```bash
    alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'
```

5. Rename the .env copy file to .env.

```bash
    mv '.env copy' .env
```

6. Initialize the Docker environment using Sail.

```bash
    sail up -d
```

7. Access the application container.

```bash
    sail shell
```
8. Generate an application key.
   
```bash
    php artisan key:generate
```

9. Run database migrations.
    
```bash
    php artisan migrate --seed
```

10.  Run npm install to install Node.js dependencies and npm run dev to compile assets.
```bash
    npm install
    npm run dev
```

## Accessing the Application

After following the steps above, the Task Manager app should be up and running and accessible through the web browser at the following address:

```
http://localhost
```

## Stopping the Sail Environment
To stop the Sail environment, exit the application shell by typing

```bash
    exit
```
and then execute the following command in the project directory:

```bash
sail down
```

---

## 😄 Made by: 
<table>
  <tr>
    <td align="center">
      <a href="https://www.linkedin.com/in/willnmafra/" title="LinkedIn Willian">
        <img src="https://media.licdn.com/dms/image/D4D03AQF1Gt96l4TlGA/profile-displayphoto-shrink_800_800/0/1694170162091?e=1714608000&v=beta&t=Es9Vtl16l0CYVz0tXNbgmIDQ_R0s3RF6NdZ1Z4yS3Ak" width="100px;" alt="Foto do Willian no LinkedIn"/><br>
        <sub>
          <b>Willian Mafra</b>
        </sub>
      </a>
    </td>
  </tr>
</table>
