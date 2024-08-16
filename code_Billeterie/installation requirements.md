## Installation des dépendence: 

```Breeze```

composer require laravel/breeze --dev

php artisan breeze:install
sudo apt-get install php8.1-curl
sudo apt-get install php8.1-opcache php8.1-pdo php8.1-xml php8.1-calendar php8.1-ctype php8.1-dom php8.1-exif php8.1-ffi php8.1-fileinfo php8.1-ftp php8.1-gettext php8.1-iconv php8.1-phar php8.1-posix php8.1-readline php8.1-shmop php8.1-simplexml php8.1-sockets php8.1-sysvmsg php8.1-sysvsem php8.1-sysvshm php8.1-tokenizer php8.1-xmlreader php8.1-xmlwriter php8.1-xsl
sudo apt-get install php8.1-pgsql
 
php artisan migrate
npm install
npm run dev

## Installation de node
```Méthode 1```

curl -fsSL https://deb.nodesource.com/setup_18.x | sudo -E bash -

sudo apt-get install nodejs

```Méthode 2```
wget -qO- https://raw.githubusercontent.com/creationix/nvm/v0.39.0/install.sh | bash

source ~/.profile

nvm ls-remote

nvm install v18.17.1

sudo apt install texlive

sudo apt install texlive-fonts-extra

sudo apt install texlive-full
sudo apt-get install php-mbstring
sudo service apache2 restart


POUR LES MAIL 
sudo ufw allow 1025

```Pour les social```
composer require laravel/socialite

```pour les datatables```
composer require yajra/laravel-datatables:^10.0


php artisan route:cache
php artisan route:clear
php artisan config:cache
php artisan config:clear
php artisan view:cache
php artisan view:clear
php artisan optimize:clear
php artisan optimize

php artisan storage:unlink
php artisan storage:link
php artisan serv


 php artisan route:list
php artisan route:list | grep produit


# Création d'une table :
php artisan make:migration create_gerants_table --create=gerants

# //pour les images
php artisan storage:link

# Si vous avez ds problèmes d'image utiliser :

php artisan storage:unlink
php artisan storage:link



npm i @popperjs/core

# Commande pour les routes
php artisan route:list | grep validations

# Commande pour les seeds

php artisan migrate:fresh --seed

php artisan make:seeder CategorieSeeder

# Installation de Maatwebsite

composer require maatwebsite/excel
# Extension zip
sudo apt-get install php-zip

# Commande pour créer un fichier d'importation excel

php artisan make:import UsersImport --model=User

# Commande pour créer un fichier d'exportation excel

php artisan make:export UsersExport --model=User

# Commande pour les roles & permissions

composer require spatie/laravel-permission



# pour utiliser les form :
composer require laravelcollective/html





#  Si vous avez une exception de type : Illuminate\Http\Exceptions\PostTooLargeException   PHP 8.1.24

vous devez modifier le fichier php.ini en fesant la commande suivante :  sudo gedit /etc/php/8.1/cli/php.ini 
puis modifier les lignes suivantes :

upload_max_filesize = 600M
post_max_size = 600M
puis redémarrer le serveur apache : sudo service apache2 restart



# composant pour les statistiques

//pour suprimer un elements : composer remove consoletvs/charts

composer require consoletvs/charts

//pour installer une version specifique :  ceci qui marche chez nous 

doc :https://charts.erik.cat/installation.html#service-provider



composer require consoletvs/charts:6.*

*Une fois le package installé, ajoutez le service provider à votre fichier config/app.php :
'providers' => [
    // ...
        ConsoleTVs\Charts\ChartsServiceProvider::class,
],

Puis, publiez les fichiers de configuration du package :

php artisan vendor:publish --tag=charts_config

//php artisan vendor:publish --tag=laravel-assets --ansi --force


# Pour l'envoie des mails :
php artisan make:mail SendMail


pour les mails : https://www.youtube.com/watch?v=Z1ktxiqyiLA&ab_channel=CodeWithDary

# Commande de raccourci php storm
ctrl + alt + s : pour ouvrir les parametres

ctrl + alt + s + s : pour ouvrir les parametres de la recherche

Alt + F1 : puis sélectionnez "Show in Explorer.

Ctrl + Shift + F10 : pour lancer le projet

Ctrl + Shift + F9 : pour déboguer le projet

Ctrl + Space : Afficher les suggestions d'achèvement du code

Alt + Insert : Ouvrir le menu de génération de code pour créer des méthodes

Ctrl + Alt + L : pour formater le code 




# Nouveau projet laravel

composer require ismaelw/laratex : pour installer le package de génération de pdf


#appele de nos appi : curl -H "API_KEY: 0x-889-y-erta" http://localhost:8000/api/data


#### Corriger la taille maiximun des ficher  : allé dans votre dossier de version de php exemple =: /etc/php/8.1/cli$   et modifier le ficher php.ini :

post_max_size = 30M





si vous avez erreur de :  
#  Call to undefined function Termwind\ValueObjects\mb_strimwidth()
sudo apt-get install php7.*-mbstring

sudo apt-get install php8.*-mbstring

 composer  install
composer dump-autoload

composer update

 php artisan migrate:fresh --seed  


# importé la base 
Importer une base de données PostgreSQL:

psql -U your_username -d your_database_name < backup.sql

---------

----


