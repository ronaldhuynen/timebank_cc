## Migrating from cyclos to laravel

# Colation:
If you want 'Géraldine' and 'Geraldine' to be considered as unique, you should use a binary collation like `utf8mb4_bin` or a case-sensitive, accent-sensitive collation like `utf8mb4_cs_as`.
Oiginal cyclos database needs this distinction, but uses an older collation type: utf8mb3_general_ci
that doesnot support emoji's.

Recommended collation Laravel database:
utf8mb4_bin


# Remove view from export before importing into laravel database:
sed '/^\/\*!50001 CREATE/,/^\/\*!50001 DELIMITER/d' /path/to/your_file.sql > /path/to/clean_file.sql
mysql -u username -p database_name < /path/to/clean_file.sql


# Remove duplicate cyclos member.name fields!
TODO: create a better procedure than the one below!

-- Create a temporary table with duplicate names and an auto-incrementing ID
CREATE TEMPORARY TABLE temp_duplicates
SELECT name, ROW_NUMBER() OVER(PARTITION BY name ORDER BY name) as row_num
FROM timebank_2024_06_11.members
WHERE name IN (SELECT name FROM timebank_2024_06_11.members GROUP BY name HAVING COUNT(*) > 1);

-- Update the `members` table by joining it with the temporary table and appending the ID to the `name`
UPDATE timebank_2024_06_11.members m
JOIN temp_duplicates d ON m.name = d.name
SET m.name = CONCAT(m.name, ' #', d.row_num)
WHERE m.name IN (SELECT name FROM temp_duplicates);

-- Drop the temporary table
DROP TEMPORARY TABLE IF EXISTS temp_duplicates;




# Cyclos members

INSERT INTO timebank_cc.users(cyclos_id, name, email, created_at, updated_at, password)
SELECT id, name, email, FROM_UNIXTIME(UNIX_TIMESTAMP(creation_date)), FROM_UNIXTIME(UNIX_TIMESTAMP(member_activation_date)), '$2y$10$/nkpEYiEQunTNaDcoBpPkuhAzLdSqx1sXzSZnXyz0jqUHrumrEDj6'
FROM `timebank_2024_06_11`.`members`
WHERE group_id = 5;