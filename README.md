# Refera - Fullstack Code Challenge

## Description

Refera's Fullstack Code Challenge Project, aims to create an API and a web page, which allows a user to register, list and view the details of a retirement request.



## Running the application: development mode

### Prerequisites

- PHP >=7
- composer
- shampoo

### Cloning the project

1st Open the terminal
2nd Enter the following command: + git clone https://github.com/cordeiroP/fullstack-challenge.git

## Install dependencies

- composer update

## Env.

-Inside the .Env file, you must change the username and password of the DBMS.
 
### migrations
- Before executing the microcrations, you must create the database (mysql), with the name "refera".
- After opening the project (being inside the project directory), enter the following command from the terminal: + php artisan migrate

### Running the services

(Optional) Create a new Python environment

```
python3 -m venv fullstack-challenge-env
fullstack-challenge-env/bin/activate source
```


### Running the server: Production environment

##Configuring the .env
- In the .env file we put the settings of the specific environment that we are going to run the application. In a production environment, two items in this file must be changed for application security:

+ APP_ENV=production
+ APP_DEBUG=false

##Installing the dependencies
- When cloning the application to our production server, the first thing we need to do is run composer to download the project's dependencies. When we are in production we can pass two extra parameters, see how the command looks like:

+ composer install --optimize-autoload --no-dev

## Caching configuration files

+ php artisan config:cache

## Caching the routes

+ php artisan route:cache

### Authentication

For authentication, one of the alternatives is the creation of a user table with the necessary fields, and a login page
where the user must provide the credentials to have access to the application.
Having the JWT configured in our API, (JSON Web Token) is a data transfer system that can be sent via POST or in an HTTP header (header) in a “secure” way, this information is digitally signed by an HMAC algorithm, or a public/private key pair using RSA, significantly increasing the security of our application.
After that, we could implement a middleware layer to verify user credentials for
all the pages you need.

### Additional database structure

#### Registration data of the real estate agency

Model changes:

- New table to store real estate agency data
- Update the order template to include an FK for RealEstateAgency

```
+ Real estate agency:
+ name: chain
+ phone: string
+ address: string
+ national_registry: string

Request:
- agency: string
+ agency: FK for RealEstateAgency
```

Other updates: Update the order serializer and endpoint to traverse the RealEstateAgency.
#### Company registration data

Model changes:

- New table to store company data
- Update the order template to include an FK for the company

```
+ Company:
+ name: chain
+ phone: string
+ address: string
+ national_registry: string

Request:
- company: chain
+ company: FK for Company
```

Other updates: Update the order serializer and endpoint to traverse the enterprise.

#### Contact record data

Model changes:

- New table to store contact data
- Update the order template to include a contact FK

```
Contact:
first_name: string
last_name: string
email: chain
username: string
password: string
phone: rope
address: chain
identity_number: string

Request:
- contact_name: string
- contact_phone: string
+ contact: FK for contact
```

Other updates: Serializer and update request endpoint to cross contact.
