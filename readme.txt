This content management system represents blogging website which has been developed as an excercise with Udemy instructor - Edwin Diaz. 
As this website works with SQL relational database, create databases tables before running this website. 
Copy and paste the cms folder to htdocs folder which is located in your XAMPP folder. The usual path for the Windows 10 users is: C:\xampp\htdocs. 
Start Apache and MySQL module in your XAMPP Control Panel and if your port is set to default (3306) run the website with 
http://localhost/cms/index.php from your browser.
Create a database with the name "cms" on phpMyAdmin and run the content of "cms.sql" on it. This script creates example articles (wikipedia.org content) with 2 
comments which both can be modified from the admin section. Initial setup contains banner pictures optained from https://www.tutorialrepublic.com which can be 
deleted from the admin section. 
After logging in with "jan" for the username and "123" for the password the user accesses the admin section from where he can 
create and manage main categories, view and manage all posts, approve and unapprove comments and create and manage users. 
Passwords are hashed with PHP's crypt method using the Blowfish encryption algorithm. More on: https://www.php.net/manual/en/function.crypt.php
All created posts are processed as drafts and are displayed on the website only after the admins approval.  Posts comments are displayed aswell 
after the admins approval. 

This website uses a free, open source, MIT licensed Bootstrap admin template from: https://startbootstrap.com/templates/sb-admin/

   