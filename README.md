# md5-file-aes-and-rc4-encrption-and-decription-with-simple-php
The code provided require you to build a database for user registration.
Anyway, it's not a good code since only file from your local folder can be encrypted.

first thing to do is to create a database named project.
then create a table named users with user_id (primary key), username and password inside it (just make it varchar).
1.Open phpMyAdmin and log in to your MySQL or MariaDB server.
2.Click on the "Databases" tab in the top navigation menu.
3.In the "Create database" section, enter "project" as the name of the new database and click the "Create" button.
4.Once the "project" database is created, select it from the list of databases on the left-hand side of the screen.
5.In the main panel, click on the "SQL" tab.
6.In the "Run SQL query/queries on database project:" box, enter the following SQL code to create the "users" table:
CREATE TABLE users (
  user_id int(11) NOT NULL AUTO_INCREMENT,
  username varchar(255) NOT NULL,
  password varchar(255) NOT NULL,
  PRIMARY KEY (user_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
7.Click the "Go" button to execute the query and create the "users" table.
then reqister with localhost/md5-file-aes-and-rc4-encrption-and-decription-with-simple-php/login.php
that's all
btw, the aes and rc4 only encrypt the plaintext on user input since.
