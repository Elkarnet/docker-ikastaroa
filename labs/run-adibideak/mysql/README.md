
Datubase zerbitzaria exekutatzeko:

```
docker run --rm --name some-mysql -e MYSQL_ROOT_PASSWORD=example -v $(pwd)/dumps:/docker-entrypoint-initdb.d -p 3306:3306 mariadb
```

Bezeroa erabiliz, kontsulta egiteko:

```
sudo apt install mysql-client
mysql -h localhost -P 3306 --protocol=tcp -u root -p
```

Beste aukera bat: ezer instalatu gabe docker bera erabili dezakegu mysql bezero gisa:

```
docker run -it --network some-network --rm mariadb mysql -hsome-mariadb -uexample-user -p
```
