# autodeploy-zodiac-webapp
This project is a PHP-based Zodiac Web Application designed for Linux LAMP servers. Users enter their name, email, and birthdate, and the app generates personalized zodiac predictions. Data is stored securely in a MariaDB database, and an admin-only panel allows viewing stored records.
(Server automation scripts are private and not included here.)

🚀 Features

1. Clean PHP frontend

2. Zodiac detection by birthdate

3. Personalized multi-line prediction messages

4. MariaDB storage via PDO

5. Admin-only records page

6. Safari-friendly date input

7. Works on any Linux + Apache + PHP setup

8. NFS server support for sharing project files across your team

🛠 Tech Stack

PHP

1. MariaDB / MySQL

2. Apache Server

4. NFS Server

3. HTML / CSS

4. Linux (RHEL / Rocky / Ubuntu)

📁 Files Included

File	        Description
index.php	    User input page
info.php	    Zodiac logic + output
records.php 	Admin-only records
dbtest.php	    Database testing
exports.php	    NFS details (optional)
README.md	    Documentation

📂 How to Run

. Upload files to /var/www/html or /var/www/project

. Create a MariaDB database

. Add a users table

. Update DB credentials in PHP files

. Make (exports) name file in /etc using vim

. Mention that export details are stored in exports.php

. Open in browser: http://server-ip/

Admin records:

http://server-ip/records.php?key=YOUR_ADMIN_KEY

🔐 Security Notes

1. Change DB username/password before deployment

2. Update admin key in records.php

3. Deployment scripts are private

🧑‍💻 Author

Kunal Grover
Linux | Automation | Server Management | PHP
