# handwars

Dies ist eine "Stein, Schere, Papier"-Implementierung.

# Developer

**Piwik Login**

https://handwars.de/piwik

Zugangsdaten sind:

user: root

pw: AufDieFingerGucken-=0
**Datenbank Schema**

**E-Mail-Acc**

mail: contact@handwars.de 
Server: mail.handwars.de 
pw: bhkjasd67x

config

                        Server-Adresse      Port  SLL       Authentifizierung
                        
Posteingangs-Server:    m1125.contabo.net   993   SLL/TLS   Passwort,normal

Postausgangs-Server:    m1125.contabo.net   465   SLL/TLS   Passwort,normal

Benutzer-Name   PE: contact@handwars.de      PA:contact@handwars.de
Table users
```
id

name(String(50))->unique

timestamp
```


Table games
```
id

url(String(50))->unique

Spieler_1 ->Forgein Key ->users

Choice_Spieler_1(String(50))

Spieler_2 ->Forgein Key ->users

Choice_Spieler_2(String(50))

gamescore ->Forgein Key ->gamesscore

Winner(String(50))

timestamp

```
Table gamesscore
```
id

Siege_Spieler_1

Unentschieden

Siege_Spieler_2

Gesamte_Spiele

timestamp

```


**Datenbank migration** 

Um die Datenbank in eurer Vagrantbox zum Laufen zu bekommen müsst ihr in einer shell am besten gitbash folgende befehle ausführen

```sh
$ cd handwars
$ vagrant up
$ vagrant ssh 
```
jetzt befindet ihr euch auf der VM und könnt hier die migration laufen lassen erstmal müsst ihr natürlich noch in den richtigen Ordner gehen das sollte so aussehen
```sh
$ cd Code/Laravel/public
$ php artisan migrate
```
danach solltet ihr 4 Meldungen bekommen die alle mit migrate anfangen das ist das Zeichen dafür das es geklappt hat .

**Vagrant**

Für die Entwicklungsumgebung werden sowohl VirtualBox als auf Vagrant genutzt.

VirtualBox: https://www.virtualbox.org/

Vagrant: https://www.vagrantup.com/

Entwicklungsumgebung einrichten:

Repository clonen:

```sh
$ git clone git@github.com:mitchobrian/handwars.git
$ cd handwars
```

Homestead für Laravel konfigurieren lassen:

- für Unix
```sh
$ ./init.sh
```

- für Windows
```sh
$ ./init.bat
```

VM hochfahren:
```sh
$ vagrant up
```

Webapplikation aufrufen:

```sh
$ firefox http://192.168.10.10.xip.io/
```

Webapplikation manipulieren:

```sh
$ vi ./site/Laravel/public/index.html
```
