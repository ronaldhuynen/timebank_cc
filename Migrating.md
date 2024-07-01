# MIGRATING CYCLOS DATABASE TO LARAVEL


# Anonymize email addresses for testing purposes

```sql
UPDATE members
SET email = CONCAT(id, '@test.nl');
```


# Collation:
If you want 'Géraldine' and 'Geraldine' to be considered as unique, you should use a binary collation like `utf8mb4_bin` or a case-sensitive, accent-sensitive collation like `utf8mb4_cs_as`.
Oiginal cyclos database needs this distinction, but uses an older collation type: utf8mb3_general_ci
that does not support emoji's.

Recommended collation Laravel database:
utf8mb4_bin
This is already set in config/database.php


# Remove view from export before importing into laravel database:
sed '/^\/\*!50001 CREATE/,/^\/\*!50001 DELIMITER/d' /path/to/your_file.sql > /path/to/clean_file.sql
mysql -u username -p database_name < /path/to/clean_file.sql



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

Cyclos member 3170 and 3633 have the same email ronald.huynen@timebank.cc this gives an migration error!


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



# Account intergrety check:


This query checks for any from_account_id in the transfers table that does not have a matching cyclos_id in the accounts table.

SELECT t.from_account_id
FROM `timebank_2024_06_11`.`transfers` t
LEFT JOIN `timebank_cc_2`.`accounts` a ON t.from_account_id = a.cyclos_id
WHERE a.cyclos_id IS NULL
GROUP BY t.from_account_id;

1801 	Timebank Amsterdam 	5 	1806 	Timebank Amsterdam 	15 	5 	Work Account
2137 	REWIRE Festival 	5 	2142 	REWIRE Festival 	27 	5 	Work Account
2260 	Volkskeuken 	5 	2265 	Volkskeuken 	14 	5 	Work Account
2437 	Walden Affairs 	5 	2442 	Walden Affairs 	27 	5 	Work Account
2673 	TimeExhibition 	5 	2679 	TimeExhibition 	27 	5 	Work Account
2687 	TB System The Hague 	5 	2693 	Timebank System Account The Hague 	13 	5 	Work Account
2692 	Timebank The Hague 	5 	2698 	Timebank The Hague 	15 	5 	Work Account
2700 	Timebank Lisbon 	5 	2699 	Timebank Lisbon 	15 	5 	Work Account
2717 	TB System Wordwide 	5 	2712 	Timebank System Account Wordwide 	13 	5 	Work Account
2718 	DHiT 	5 	2713 	Den Haag in Transitie 	14 	5 	Work Account
3063 	TTT 	5 	3059 	Timebank Transport Team 	14 	5 	Work Account
3084 	Timebank BXL 	5 	3080 	Timebank Brussels/Brussel/Bruxelles 	15 	5 	Work Account
3147 	REWIRE Festival 	6 	2142 	REWIRE Festival 	27 	6 	~ Gift Account
3151 	TTT 	6 	3059 	Timebank Transport Team 	14 	6 	~ Gift Account
3192 	DHiT 	6 	2713 	Den Haag in Transitie 	14 	6 	~ Gift Account
3259 	TEST User 1. 	5 	3156 	TEST User 1. 	22 	5 	Work Account
3261 	TEST Project 1. 	7 	3157 	TEST Project 1. 	18 	7 	Project account
3274 	TEST User 2. 	5 	3170 	TEST User 2. 	6 	5 	Work Account
3275 	TEST User 2. 	6 	3170 	TEST User 2. 	6 	6 	~ Gift Account
8267 	Removed user 4658 	7 	4658 	Removed user 4658 	8 	7 	Project account

Result: 19 rows


Similarly, this query checks for any to_account_id in the transfers table that does not have a matching cyclos_id in the accounts table.

SELECT t.to_account_id
FROM `timebank_2024_06_11`.`transfers` t
LEFT JOIN `timebank_cc_2`.`accounts` a ON t.to_account_id = a.cyclos_id
WHERE a.cyclos_id IS NULL
GROUP BY t.to_account_id;

account_id Ascending 1 	owner_name 	account_type_id 	member_id 	name 	group_id 	account_type_id 	account_type_name 	
1801 	Timebank Amsterdam 	5 	1806 	Timebank Amsterdam 	15 	5 	Work Account
2137 	REWIRE Festival 	5 	2142 	REWIRE Festival 	27 	5 	Work Account
2260 	Volkskeuken 	5 	2265 	Volkskeuken 	14 	5 	Work Account
2437 	Walden Affairs 	5 	2442 	Walden Affairs 	27 	5 	Work Account
2673 	TimeExhibition 	5 	2679 	TimeExhibition 	27 	5 	Work Account
2687 	TB System The Hague 	5 	2693 	Timebank System Account The Hague 	13 	5 	Work Account
2692 	Timebank The Hague 	5 	2698 	Timebank The Hague 	15 	5 	Work Account
2700 	Timebank Lisbon 	5 	2699 	Timebank Lisbon 	15 	5 	Work Account
2717 	TB System Wordwide 	5 	2712 	Timebank System Account Wordwide 	13 	5 	Work Account
2718 	DHiT 	5 	2713 	Den Haag in Transitie 	14 	5 	Work Account
3063 	TTT 	5 	3059 	Timebank Transport Team 	14 	5 	Work Account
3084 	Timebank BXL 	5 	3080 	Timebank Brussels/Brussel/Bruxelles 	15 	5 	Work Account
3147 	REWIRE Festival 	6 	2142 	REWIRE Festival 	27 	6 	~ Gift Account
3151 	TTT 	6 	3059 	Timebank Transport Team 	14 	6 	~ Gift Account
3192 	DHiT 	6 	2713 	Den Haag in Transitie 	14 	6 	~ Gift Account
3259 	TEST User 1. 	5 	3156 	TEST User 1. 	22 	5 	Work Account
3260 	TEST User 1. 	6 	3156 	TEST User 1. 	22 	6 	~ Gift Account
3261 	TEST Project 1. 	7 	3157 	TEST Project 1. 	18 	7 	Project account
3274 	TEST User 2. 	5 	3170 	TEST User 2. 	6 	5 	Work Account
3275 	TEST User 2. 	6 	3170 	TEST User 2. 	6 	6 	~ Gift Account
5353 	REWIRE Festival 	7 	2142 	REWIRE Festival 	27 	7 	Project account
5355 	Walden Affairs 	7 	2442 	Walden Affairs 	27 	7 	Project account
8267 	Removed user 4658 	7 	4658 	Removed user 4658 	8 	7 	Project account
Result: 22 rows


Query to combine the two groups and removing duplicates:




WITH CombinedAccounts AS (
    SELECT t.from_account_id AS account_id
    FROM `timebank_2024_06_11`.`transfers` t
    LEFT JOIN `timebank_cc_2`.`accounts` a ON t.from_account_id = a.cyclos_id
    WHERE a.cyclos_id IS NULL
    GROUP BY t.from_account_id

    UNION

    SELECT t.to_account_id
    FROM `timebank_2024_06_11`.`transfers` t
    LEFT JOIN `timebank_cc_2`.`accounts` a ON t.to_account_id = a.cyclos_id
    WHERE a.cyclos_id IS NULL
    GROUP BY t.to_account_id
)

SELECT 
    ca.account_id, 
    a.owner_name, 
    a.type_id AS account_type_id, 
    m.id AS member_id, 
    m.name, 
    m.group_id 
    at.id AS account_type_id, 
    at.name AS account_type_name
FROM 
    CombinedAccounts ca
JOIN 
    timebank_2024_06_11.accounts a ON ca.account_id = a.id
JOIN 
    timebank_2024_06_11.members m ON a.member_id = m.id
JOIN 
    timebank_2024_06_11.account_types at ON a.type_id = at.id;

 Showing rows 0 - 15 (16 total, Query took 0.0353 seconds.) 