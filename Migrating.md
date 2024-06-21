## Migrating from cyclos to laravel


# Remove view from export before importing into laravel database:
sed '/^\/\*!50001 CREATE/,/^\/\*!50001 DELIMITER/d' /path/to/your_file.sql > /path/to/clean_file.sql
mysql -u username -p database_name < /path/to/clean_file.sql


# Cyclos members

INSERT INTO timebank_cc_2.users(cyclos_id, name, email, created_at, updated_at)
SELECT id, name, email, FROM_UNIXTIME(UNIX_TIMESTAMP(_date)), FROM_UNIXTIME(UNIX_TIMESTAMP(member_activation_date))
FROM timebank.cc_2024_06_11.members
WHERE group_id = 5;