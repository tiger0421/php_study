# php_study
I create this repository to study PHP.

## Environment
- Windows 10 Pro 1909
- Docker for windows
- PHP server 7.2-apache

## Usage
1. Run a container  
`
$ docker run -it --rm -v C:\Users\user\php_study\scripts:/var/www/html -p 80:80 php:7.2-apache
`
 
2. Access your container
If you saved php script on host in `C:\Users\user\php_study\scripts\Hello.php`,  
access `localhost:80/Hello.php` with your web browser.  
  
Also, you can debug with VS code to use an extension, "php server".

## License
MIT
