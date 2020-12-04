Improvement still required:
- not allow employee to checkin more than once in a day.
- ~~create an admin login screen.~~ implemented local admin login without database.
- improve admin login with md5 and database saved password.
- add ability for admin to update login password.
- ~~provide admin related functionality only to admin user (edit/delete user, print (copy, pdf, csv, xlsx, hard print).~~ implemented
- ~~ability to select 'from' and 'to' date for the admin backend instead of showing only daily check in on the front end~~ implemented
- ~~added ability to print with Brother QL-700 (requires Python 3 and ![Brother_ql](https://github.com/pklaus/brother_ql) project installed~~)
- added to seperate check in buttons, one for employee and one for visitor
- added automatic print of badge for visitor with qrcode summarising check in details.

Building a CRUD (Create Read Update Delete) application with PHP/MySQL/Bootstrap4/datatable for employee checkin/checkout purpose.
# User Front End
![image](https://user-images.githubusercontent.com/67799618/91454579-0cb38580-e879-11ea-9f6f-06c697b7e294.png)
# Admin Login
![image](https://user-images.githubusercontent.com/67799618/91454815-4a181300-e879-11ea-9474-8ebb9228b3f3.png)
(username: admin, password:123456)
# Admin Backend
![image](https://user-images.githubusercontent.com/67799618/91455044-877ca080-e879-11ea-8e8f-7423f1b74c0c.png)
# MySQL commands needed
## INSERT (CREATE)
```SQL
INSERT INTO table ( col1, col2 ) VALUES ('val1', 'val2' )
```

## SELECT (READ)
```SQL
SELECT * FROM table WHERE col1 = 'val1' AND col2 = 'val2'
```

## UPDATE
```SQL
UPDATE table set col1 = 'val1', col2 = 'val2' WHERE col3 = 'val3
```

## DELETE
```SQL
DELETE FROM table WHERE col1 = 'val1'
```

# Database structure
![image](https://user-images.githubusercontent.com/67799618/91453588-d9242b80-e877-11ea-9d06-8068e40cceff.png)
