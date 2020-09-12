# Parking Meter 
This is a desktop platform  created for Academic purposes of "Web Programming and Systems".On startpage we have the main page which prompts the user to login either as an admin or as a quest and it's showing the polygons on the map.The polygons are fitted to leaflet map reading and extracting the coordinates from a klm file.All the data are passed into MySql Database so the user or admin can do changes like insert available parking spots or search for the nearest parking spot which the user want to park.The available klm file  used is for "Thessaloniki" town in Greece but you can upload whatever klm file you want.

# Building

 Clone repository
 
`git clone <<repository address>> `
## Linux User
`cd web`

`php -S localhost:8000`

Then the server starts and you will see the start page in your browser on 8000 port.

## Windows

You can use Jetbrains phpStorm or vsCode

# Database Creation

In order to use database you have to install phpMyAdmin and browse database file from project folder.Then you can start the server.
