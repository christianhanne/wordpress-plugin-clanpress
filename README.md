# Clanpress - Wordpress Plugin

## Introduction

Clanpress is a full featured clan management plugin. Customers can manage games, squads, manages,
sponsors and many more features through this plugin.

## Development

Clanpress is development using a gulp workflow. The following tasks are available:

| Command | Description |
| --- | --- |
| gulp | Default task, compiles js and scss files. |
| gulp publish | Creates a zip file of the current application state. |
| gulp docs:create | Create documentation. |
| gulp docs:publish | Uploads documentation to an ftp server. |
| gulp clean | Removes all previously compiled files. |

Use `npm install` to install all required dependencies.

The following file will have to be created manually:

```json
{
  "host": "clan.press",
  "port": 21,
  "user": "USERNAME",
  "password": "PASSWORD",
  "parallel": 5
}

```
