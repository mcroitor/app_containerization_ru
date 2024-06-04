# _yacms_

Yet another CMS, the 4th iteration.

Rewritten, uses microservices. Default database is sqlite.

## how to install

Do this:
```bash
git clone https://github.com/mcroitor/yacms
php -t yacms/ -S localhost:8000
```
Site will be started at http://localhost:8000 using PHP built-in server.
Access it and firstly you will be redirected to installation script.

## Structure:

<pre>yacms
+-- <b>core</b> - default functionality
|   +-- <i>database</i> - defines classes for DB access
|   +-- <i>logger</i> - common logger class
|   +-- <i>router</i> - router class
|   +-- <i>template</i> - simple template filling
|   +-- <i>module.interface.php</i> - common interface for modules
|   +-- <i>modulemanager.class.php</i> - module manager
|   +-- <i>page.class.php</i> - page rendering
|   +-- <i>site.class.php</i> - static class - site agregator
+-- <b>help</b> - documentation
+-- <b>install</b> - installation scripts
|   +-- <i>config.sample.php</i> - configuration file sample
|   +-- <i>index.php</i> - installation script
|   +-- <i>sqlite.sql</i> - initial structure of tables
|   +-- <i>stages.php</i> - installation staging
+-- <b>libs</b> - external libraries
|   +-- <i>api.js</i> - simple ajax requests
+-- <b>modules</b> - extentions
|   +-- <i>article</i> - article sample module
|   +-- <i>user</i> - user module
|       +-- <i>db</i> - install / uninstall
|       +-- <i>templates</i> - module templates
|       +-- <i>user.class.php</i> - module implementation
+-- <b>site templates</b> - common templates
+-- <b>themes</b> - themes
|   +-- <b>default</b> - default theme
+-- <i>config.php</i> - configuration file
+-- <i>index.php</i> - entry point
</pre>
