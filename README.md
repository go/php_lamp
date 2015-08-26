# php_lamp
### What's this?
This is sample code to learn architecture of web system at internal meetup

### How to use
After cloned this code, you can running on several ways

    # git clone https://github.com/go/php_lamp.git

#### With Web server

Simply copy or link *html* directory to your DocumentRoot

    # cp -r php_lamp/html <YOUR DOCUMENTROOT>

or

    # ln -s php_lamp/html <YOUR DOCUMENTROOT>

#### Running as Container

You can running this code by docker-compose

    # cd php_lamp
    # docker-compose up -d
