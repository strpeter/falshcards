falshcards
==========

The falshcards repository is a project in development to create flashcards. The letter K in "project K" refers to the german word Karteikarten.

Installation
============
0. Clone me: In the folder ~/public_html, execute: ```git clone git@github.com:strpeter/falshcards.git```
1. Install Composer in folder ProjectK/Symfony: ```curl -s https://getcomposer.org/installer | php```
2. Install Symfony vendors: ```php composer.phar install```
3. Setup MySQL: Create a user (eg the user falshcards with password asdf, using the GUI-Tool called MySQL Administrator) and write its login into the Symfony parameters file ProjectK/Symfony/app/config/parameters.yml
4. Create the Database: In folder ProjectK/Symfony, run: ```php app/console doctrine:schema:update --force```
5. Open your Browser (http://localhost/~modurex/falshcards/ProjectK/Symfony/web/app_dev.php/falshcards/) and enjoy!
