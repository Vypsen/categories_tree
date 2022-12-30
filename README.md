# Command for test

## Instruction 
1. Clone the project `git clone https://github.com/vypsen/categories_tree.git`
2. run `$ docker-compose build`
3. run `$ docker-compose up -d`
4. create DB: host = 'localhost', port = 5432, db = 'db', user = 'user', password = 'secret'. And create table in index.sql
5. run `$ docker exec -it categories_tree_php_1  bash`
6. for import in DB: `php importInDB.php`
7. go to http://localhost
8. run `php createType_a.php` and check type_a.txt
9. run `php createType_b.php` and check type_b.txt
