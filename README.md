# Blog Symfony 4

A simple using example of PHP Symfony 4

## This blog allows you to :
- Register
- Login
- Create articles
- Edit your articles
(Other features could be added)

## Setup the project :

    composer update (project directory)
    Create file .env.local with database parameters (username, password, database name)
    php bin/console d:d:c (Create database)
    php bin/console d:s:u --force (Update database)
    
    php bin/console d:f:l (Fixture that will create a defined users, 10 others users and 10 articles

## Test it :
  login : test  
  mdp : symfony87
