# WorkTime

WorkTime ist ein OpenSource tool um Überstunden zu tracken.

## Installation
- ```git clone https://github.com/cngjo/WorkTime``` in dem root-Verzeichnis des Webservers
- ```cd WorkTime``` ausfürhren 
- ```composer update``` ausfürhren 
- ```db.sql``` in dem SQL Server ausführen
- ```App/Config/db.cfg``` Datei erstellen mit 
```ini
[globals]
; your Database host
DB_HOST=
; your Database username
DB_USER=
; your Database username's password
DB_PASS=
; your table name
DB_NAME=worktime
```
