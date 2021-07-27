# TODO
- 26-07-2021 (1hr)
    - [X] project setup
    - [X] form (Flow)

- 27-07-2021 (4hr)
    - [X] survey schema & save
    - [X] check full of Survey
    - [X] CRSF Token / Recaptcha
    - [X] create account & user table
    - [X] login Protection for online report
    - [X] online report (full logs)
    - [X] random data for report

- 28-07-2021
- [ ] online report (entry per chosen color)
- [ ] online report (entry per house of the day)
- [ ] period report
- [ ] email sending

# Nice to have
- [ ] csrf token in login form
- [ ] XSS protection
- [ ] enable security cookie to prevent the session cookie (need to use SSL which this docker setup is not suitable)
- [ ] move config to .env

# Test case
- [ ] Test field input
- [ ] invalid color
- [ ] required & non required
- [ ] repeated email
- [ ] Test form submission after limit
- [ ] Test stats data
- [ ] Test login function (login logout incorrect password)

# Notes

- For easier to setup, I just commit the vendor code of composer and dump the db sql (no migration need).
- SSL should be used on load balancer level. So I do not enable any SSL setup like security cookie.
- Security header is skipped in this stage
When you setup the server, you can add the header below
```
BrowserMatch MSIE ie
Header set X-UA-Compatible "IE=Edge,chrome=1" env=ie
Header always set Strict-Transport-Security "max-age=63072000; includeSubdomains; preload"
Header always set X-Content-Type-Options "nosniff"
Header always set X-Frame-Options "SAMEORIGIN"
Header always set Content-Security-Policy "upgrade-insecure-requests;"
Header always set X-Xss-Protection "1; mode=block"
Header always set Referrer-Policy "no-referrer-when-downgrade"
```
- not manage the config in .env
- not good handling any cross site script into user input (actually it can done by application firewall. it is not a must in this stage)


# Setup

- Start the server with docker-compose
```
docker-compose up -d
```
- Browse the web application on `http://localhost:3000`
- Import DB
```
docker exec -it code-challenge_mariadb_1 mysql -uroot -proot bitnami_app < db.sql
```
- Run migrate (if you skip mport db and want a clean installation)
```
http://localhost:3000/migrate
```
- Change environment to production

# Entry Points
survey: https://localhost:3000/
online report: https://localhost:3000/report

# Login Accounts (random generated 10 accounts)
user0 / o0ouser0
user1 / o0ouser2
...
user9 / o0ouser9
