# HomeInventory
Home Inventory system to keep track of your house hold items, their location, and their catagory with an optional picture and comments.

#Requirement

- Apache webserver
- PHP5
- MySQL

#Configure

Install Apache with the other dependent files

<code>
sudo apt-get install apache2
</code>
<br>
<code>
sudo apt-get install php5
</code>
<br>
<code>
sudo apt-get install libapache2-mod-php5
</code>
<br>
<code>
sudo /etc/init.d/apache2 restart
</code>


Install MySQL server 


<code>
sudo apt-get install mysql-server
</code>

After that login to the database

<code>
mysql -u root -p
</code>

Create the new Database that will hold the inventory tables

<code>
CREATE DATABASE dbname;
</code>

Then use the database and add the table to it
<br>
<code>
USE dbname;
</code>
<br><br>

DROP TABLE IF EXISTS `inventory`;
CREATE TABLE `inventory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(24) NOT NULL,
  `catagory` varchar(35) NOT NULL,
  `quantity` int(11) NOT NULL,
  `picture_index` varchar(100) DEFAULT NULL,
  `location` varchar(25) NOT NULL,
  `comments` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

<br><br>

Next append the repository to /var/www directory
and create two folders
<br>
<code>
sudo mkdir uploads
</code>
<br>
<code>
sudo mkdir uploads/thumbs
</code>

Then change the folder permissions to 
<br>
<code>
sudo chmod 777 uploads
</code>
<br>
<code>
sudo chmod 777 uploads/thumbs
</code>

Then go to assets/includes/csl_config.php
and update the database name, user, password, table 

After that go to localhost on the browser and it should be setup!

#Future Work

- Adding search filter
- Filtering by tags
