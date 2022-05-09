# Symfony 6.0.8 Skeleton & Sonata Admin Bundle


Install dependencies:
```
composer install
```

Configure database (.env) and run:
```
php bin/console doctrine:schema:update --force
```

Create admin user and install assets:
```
php bin/console sonata:user:create --super-admin username email@domain.com password
php bin/console assets:install public --symlink --relative
```

Install and build client dependencies:
```
yarn
yarn dev
```

Run local server:
```
symfony serve --port 8080 --no-tls
```

Navigate to http://localhost:8080/admin and login with the user you created earlier