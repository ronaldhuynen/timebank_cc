# MIGRATING CYCLOS DATABASE TO LARAVEL


# Anonymize email addresses for testing purposes

```sql
UPDATE members
SET email = CONCAT(id, '@test.nl');
```

# Remove view from export before importing into laravel database:
sed '/^\/\*!50001 CREATE/,/^\/\*!50001 DELIMITER/d' /path/to/your_file.sql > /path/to/clean_file.sql
mysql -u username -p database_name < /path/to/clean_file.sql


# Remove duplicate cyclos member.name fields!
First check which names are not unique from groups_id  = 5 (Users), remove users that have last_login = NULL

```sql
SELECT m1.id AS id_members, m1.name, m1.group_id, m1.email, m1.creation_date, m1.member_activation_date, m1.hide_email,
       u.id AS id_users, u.last_login, u.username, u.password, u.salt
FROM members m1
JOIN users u ON m1.id = u.id
WHERE m1.group_id = 5
AND u.last_login IS NOT NULL
AND EXISTS (
    SELECT 1
    FROM members m2
    WHERE m1.name = m2.name AND m1.id <> m2.id AND m2.group_id = 5
)
ORDER BY `m1`.`name` ASC
```


What to do with these +/- 47 users? Add a trailing number to their name, so they can change it themselves later? Or change name into username?  See query below:
```sql
UPDATE members m1
JOIN users u ON m1.id = u.id
SET m1.name = u.username
WHERE m1.group_id = 5
AND u.last_login IS NOT NULL
AND EXISTS (
    SELECT 1
    FROM members m2
    WHERE m1.name = m2.name AND m1.id <> m2.id AND m2.group_id = 5
);
```
Decide with board if we should continue using a username and full name. In cyclos, email and full name can be changed, but username can not. Also username and email should be unique. In Laravel, name can not  be changed by user, email can be changed. We could also set the cyclos username as account name of the laravel user.

## Cyclos members

1. System Administrators
5. Users
6. Inactive Users
8. Removed Users
13. Local Bank (Level I)
14. Projects
15. Project to create Hours (level II) 
17. Local Admin
18. TEST: Projects
22. TEST: Users
27. Inactive Projects

---
Excluded from  migration:
System Administrators (cyclos group_id 1)
Local Admin (cyclos group_id 17)
(As no admin table is yet created. The super-admin is created during db:seed process.)
TEST: Projects
TEST: Users
Inactive Projects 
(As no cyclos members are inside these groups)

Included in migration:
Users (cyclos group_id 5):
Inactive Users (cyclos group_id 6)
Removed Users (cyclos group_id 8):
Local Bank (Level I) (Cyclos group_id 13)
Organizations (cyclos group_id 14)

To migrate execute:
php artisan migrate:cyclos_users


## Cyclos member accounts
Cyclos account types:
1 = Debit account
2 = Community account
3 = Voucher account (not used)
4 = Organization account (not used)
5 = Work account users
6 = Gift account users
7 = Project account projects

In Cyclos, a User owning a Work Account, could change into a Project and then it would own a Project Account, and vice versa.
In the Cyclos db these both accounts remain to exist. However their member_status would change between A and I (active and inactive). The only difference between the account types is the owner permission group and the upper and lower credit limits. Therefore this historic data does not need to be migrated into Laravel. During the migration the current permission group (user or organization) decides the height of the Laravel account limits. Only currently active accounts are migrated: users get 2 accounts (work and a gift) and organizations a single (project) account.



