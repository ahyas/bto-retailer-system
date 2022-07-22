Installation process:
Before it begins, make sure you have PHP and MySQL installed on your system(you can install it from xampp folder came along with this app), and since it uses Laravel we also suggest you to install Composer.

[STEP 1]
Create database and name it as you wish using PHPMyAdmin. Import database from the "db" directory.

[STEP 2]
Extract app into your preferred directory (xampp/htdocs/<your directory>). Edit ".env" file and fill in your database info 
DB_DATABASE=<your database name>
DB_USERNAME=<your database username>
DB_PASSWORD=<your database password>

[STEP 3]
Up to this point, the installation process is done. Open your browser and visit: localhost/<your app folder> 