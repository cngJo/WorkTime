# WorkTime

WorkTime is an OpenSource application, in which you can track your overtime

**Attention, please install this only on your local machine, everyone who has access can run scripts do delete your database**  
**WorkTime is still under development, so there can be bugs and security issues, use on own risk!**

## Installation
- Clone the Repository ```git clone https://github.com/cngjo/worktime```
- update composer packages in the cloned directory ```composer update```
- Run the installation script, you can find behind the route /install

## Guide (todo: improve | add screenshots | move -> wiki)

### build up overtime
when you want to build up overtime, you cen either go to ```/get``` or you use the ```overtime```
Button on the home page.

### reduce overtime
when you want to reduce overtime, you cen either go to ```/take``` or you use the ```reduce```
Button on the home page.

## Supported Languages  
At the moment only German and English (de_DE | en_US) are supported languages, you can add your own 
translation, by adding the language code to the languages array in the ```App/Config/config.cfg``` file 
and add a .cfg file with the corresponding language code as name to the ```App/Config/langauges``` folder.
