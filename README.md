# Dashboard in LAMP

Dieser Branch enthält die fertige Dashboard-Aplikation .

## Hinweise 

* Achten Sie darauf, dass die Informationen für den Datenbank Login in __data.php__ eingetragen werden müssen!
    *
* Auf Ihrem Server müssen die Komponenten des LAMP-Stacks installiert sein.
    *


## Struktur

Dieser Branch enthält folgende Dateien:
    .
    ├── api.php                   # Wickelt den Aufruf einer externen API ab.
    ├── build_data_table.php	  # Bereitet Daten für die Darstellung vor.
    ├── data.php                  # Hier werden Datenbankabfragen verwaltet.
    ├── index.php                 # Diese Datei wird beim initialen Aufruf abgefragt.   
    ├── script.js                 # Enthält Skripts, die clientseitig ausgeführt werden.
    ├── style.css                 # Enthält Informationen zur Darstellung der Webseite.
    └── README.md