# PHP Gallery
 Open source PHP gallery.
 You're able share your photos with everyone you want, securely via web browser.

 ## Key features
 - Creating unlimited number of galleries albums and subalbums
 - Locking single galleries or albums with password
 - Making galleries and albums private
 - User login and sign up
 - Users administration
 - Multiple images upload
 - Custom themes

 ## System requirements
- Apache server (Nginx doesn't support .htacces file)
- PHP 8.0 or higher
- MySQL or MariaDB

 ## Installation
 - Set up MySQL or MariaDB server with empty database
 - Copy content of 'src' folder to your web server
 - Launch website, you will be redirect to installation wizard automatically
 - Firstly, enter DB login credentials, then make your account and fill in basic informations about your copy od this software
 - After successful installation you will be redirect to login page.
 - You must save the settings page for create .htaccess file
 - Then you're done!

   Note: gallery URL must be without domain. E. g. if your gallery is at this URL: `https://example.com/gallery/`. Enter `/gallery/` in the gallery URL field. If our gallery is in the root folder Enter only `/`.

 ## Themes
 You can add themes to your gallery. There are two themes, that are supplied with every copy:
 - Default theme
 - Bootstrap 3 theme

 You can also make your own theme. The manual for this is bellow this article.

 ## How to make own theme
 Making own theme is really simple, if you now CSS. Your theme folder must contains:
 - Manifest file
 - Components folder
 - At least one stylesheet file in styles folder

### Structure of `manifest.json`
```
{
    "theme_name" : "My Theme",
    "theme_identifier" : "my-theme",
    "theme_version" : "1.0.0",
    "theme_author" : "John Doe",
    "theme_contributoin" : "(c) 2024 John Doe",
    "theme_id" : "1",
    "theme_description" : "My theme for PHP open-source Gallery",
    "theme_icon" : "icon.png",
    "theme_thumbnail" : "thumbnail.png",
    "theme_components" : {
        "styles" : {
            "stylesheet" : "index.css",
        },
        "scripts" : {
            "javascript" : "index.js"
        }
    }
}
```
### Files structure of your theme corresponding with `manifest.json`
```
my_theme
|_ manifest.json
|_ components
| |_ style
| | |_ index.css
| |_ scripts
|   |_ index.js
|_ img
   |_ icon.png
   |_ thumbnail.png
```
### List of required files and folders
- manifest.json
- components (folder)
- styles (folder)
- index.css
