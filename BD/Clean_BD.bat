echo bonjour, je te souhaite une boonne journée.
echo USE cegepjon_p2017_2_dev; > temp.sql
TYPE 1.sql >> temp.sql
TYPE DUMP\allTables.sql >> temp.sql
echo USE cegepjon_p2017_2_tests; >> temp.sql
TYPE 1.sql >> temp.sql
TYPE DUMP\allTables.sql >> temp.sql
echo USE cegepjon_p2017_2_prod; >> temp.sql
TYPE 1.sql >> temp.sql
TYPE DUMP\allTables.sql >> temp.sql
mysql -h dicj.info -u cegepjon_p2017_2 -p madfpfadshdb
PAUSE
del temp.sql