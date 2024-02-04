<!-- ABOUT THE PROJECT -->
## About The Project

![All accounts](/img/1.jpg)
![New account](/img/2.jpg)
![Add funds](/img/3.jpg)




<!-- AIM OF THE PROJECT -->
## Aim of the project

* Create an authorization system. (singleton pattern)
* Display messages after operations (singleton pattern)
* Create new accounts with:

  * Name
  * Lastname
  * Personal code number (only real personal codes are accepted, to generate one use: https://www.runa.lt/useful/asmens_kodas)
  * Bank account number (generated automatically, readonly)
* Add / Withdraw funds
  * Can't withdraw / add negative amounts or amounts higher than accounts balance
* Delete account
  * Only an account with a zero balance can be deleted
* Database
  * It is possible to make entries in json file or database
  * If you want to write and read data from json file in public/index.php file uncomment 'file' row and comment 'maria' row and vice versa.
  * ![Database](/img/4.jpg)
  * SQL base employee email: employee@maria.lt, password: 12345678
  * FileBase employee email: employee1@gmail.com, password: 12345678
  * Two files were exported from the databases: employees and accounts. They are located in root project folder

<!-- GETTING STARTED -->
## Getting Started


1. Clone the repo 
   ```sh
   git clone https://github.com/kasparasd/php-bank-oop.git
   ```
2. Install NPM packages
   ```sh
   npm install
   ```
3. Install composer packages
   ```sh
   composer install
   ```
4. Open project: http://localhost/php-bank-oop/public/

















