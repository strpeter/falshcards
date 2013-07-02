falshcards
==========
The falshcards repository is a project in development to create flashcards. The letter K in "project K" refers to the german word Karteikarten.

Installation
------------
0. Clone me: In your server root folder (eg ```~/public_html```), execute: ```git clone git@github.com:strpeter/falshcards.git```
1. Install Composer in folder ```ProjectK/Symfony```: ```curl -s https://getcomposer.org/installer | php```
2. Install Symfony vendors: ```php composer.phar install```
3. Setup MySQL: Create a user and database (eg database ```falshcards```, and the user ```falshcards``` with password ```asdf```, using the GUI-Tool called MySQL Administrator) and write its login into the Symfony parameters file ProjectK/Symfony/app/config/parameters.yml
4. Create the database tables: In folder ProjectK/Symfony, run: ```php app/console doctrine:schema:update --force```
5. Open your browser (http://localhost/~user/falshcards/ProjectK/Symfony/web/app_dev.php/falshcards/) and enjoy!

About
-----
falshcards was initiated by [strpeter](https://github.com/strpeter) and for contributors see [here](https://github.com/strpeter/falshcards/contributors)

License
-------
This repository is called falshcards and provides a web application for exchange of flashcards using LaTeX.
Copyright (C) 2012-2013  strpeter

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU Affero General Public License as
    published by the Free Software Foundation, either version 3 of the
    License, or (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU Affero General Public License for more details.

    You should have received a copy of the GNU Affero General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.


    This file is part of falshcards.

    falshcards is free software: you can redistribute it and/or modify
    it under the terms of the GNU Affero General Public License as
    published by the Free Software Foundation, either version 3 of the
    License, or (at your option) any later version.

    falshcards is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU Affero General Public License for more details.

    You should have received a copy of the GNU Affero General Public License
    along with falshcards.  If not, see <http://www.gnu.org/licenses/>.
