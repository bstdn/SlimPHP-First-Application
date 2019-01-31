# SlimPHP First Application

It is a very simple Slim project to serve as an example application of using Slim 3 with Monolog, PHP views and Composer to manage dependencies.  In order to use the application as it stands:
    
* run `php composer.phar install` to get the dependencies

* copy `public/config_example.php` as `public/config.php`

* copy `application/config/development_example` as `application/config/development`

Nginx config:

```
server {
    listen 80;
    server_name mydomain.text;
    index index.php index.html index.htm;
    root /path/public;

    location / {
        try_files $uri $uri/ /index.php$is_args$args;
    }

    location ~ \.php {
        try_files $uri =404;
        fastcgi_split_path_info ^(.+\.php)(/.+)$;
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        fastcgi_param SCRIPT_NAME $fastcgi_script_name;
        fastcgi_index index.php;
        fastcgi_pass 127.0.0.1:9000;
    }
}
```
