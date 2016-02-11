# jQuery Teamspeak 3 Status

This plugin displays a simple Teamspeak 3 server status widget utilizing the
"Simple REST API" from Planet Teamspeak (https://www.planetteamspeak.com).
Please note that there is also a more complex plugin in place, which will
display a Teamspeak3 server in a tree view
(https://github.com/planetteamspeak/jquery-ts3viewer).

## Demo

Play around with the demo on JSFiddle:
https://jsfiddle.net/aureolacodes/uL7j18xq/

## Requirements

The following passage is a quote from the jQuery REST API TSViewer README file.

Using the default settings, the plugin with utilize the Simple REST API
endpoints at api.planetteamspeak.com to gather the necessary data from a
TeamSpeak 3 Server. Therefore, the server must meet the following requirements:

* The TS3 Server must report to the official server list on
weblist.teamspeak.com and appear in the Global Server List on the
Planet TeamSpeak website.
* The owner of the TS3 Server must register (claim) it on the on the Planet
TeamSpeak website and enable ServerQuery connectivity in the Control Panel.
* ServerQuery connections are initiated from 37.59.113.89, 167.114.184.17
and 151.80.148.48 so please consider adding those IPs to the TS3
Server whitelist file.

## Usage

To add the widget include the plugin's script files along with jQuery in your
markup. To initialize it, run ts3status on your target container. `host` and
`port` are required for basic usage. Check below for more info on the
configuration options.

```html
  <!doctype HTML>
  <html>
  <head>
    <script src="jquery.js"></script>
    <script src="jquery.ts3status.min.js"></script>
  </head>
  <body>
    <div id="ts3status"></div>
    <script>
      $('#ts3status').ts3status({
        host: '82.211.30.15',
        port: '9987'
      });
    </script>
  </body>
  </html>
```

## Configuration

The following options are available through the configuration object.

| Option | Default | Description |
| --- | --- | --- |
| api | https://api.planetteamspeak.com/serverstatus | Url of the simple rest api. |
| host | localhost | Your server's host name, e.g. 82.211.30.15 |
| port | 80 | Your server's port, e.g. 9987 |
| rate | 10000 | The plugin will update the server status every x milliseconds. The default value is 10000ms, so the status will be updated every 10 seconds. |
| onSuccess | function() {} | Callback that runs after a successful request. Will get the api response as a parameter. Please check https://www.planetteamspeak.com/rest-api/ for more details on this. |
| onError | function() {} | Callback that runs after a failed request. Will get the api response as a parameter. Please check https://www.planetteamspeak.com/rest-api/ for more details on this. |

## Disclaimer

This plugin has originally been developed for Clanzilla (http://www.clanzilla.de).
