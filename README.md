Improvement still required:
- not allow employee to checkin more than once in a day.
- ~~create an admin login screen.~~ implemented local admin login without database.
- improve admin login with md5 and database saved password.
- add ability for admin to update login password.
- ~~provide admin related functionality only to admin user (edit/delete user, print (copy, pdf, csv, xlsx, hard print).~~ implemented
- ~~ability to select 'from' and 'to' date for the admin backend instead of showing only daily check in on the front end~~ implemented

Building a CRUD (Create Read Update Delete) application with PHP/MySQL/Bootstrap4/datatable for employee checkin/checkout purpose.
![image](https://user-images.githubusercontent.com/67799618/90959493-61c75400-e493-11ea-8ef1-e49c9cc73cc5.png)
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
