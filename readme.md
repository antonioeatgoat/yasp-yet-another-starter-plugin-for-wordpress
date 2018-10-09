# YASP - Yet Another Starter Plugin for WordPress

A well-organized, easy-to-use, object-oriented boilerplate to create your next high-quality WordPress Plugin
efficiently.

## Features

- Totally fits all WordPress standard and guidelines
- Takes care of the OOP
- Well-organized files and folders
- All files, classes and methods are deeply commented
- Settings options system that implements WordPress Settings API
- Automatically loads only needed files
- Stylesheets built with Sass
- Gulp tasks ready to use 

## Getting Started

It's assumed that you will rename many parts of the plugin, such as name, slug, language context, files name, etc.

You can use the online [YASP Generator](http://www.wpstarterplugin.com) to generate your renamed package in just
seconds.  

If for any reason you prefer generate manually your package, then follow these steps in order to replace all the strings
 properly.
When you perform the search-and-replace, search for the strings in the whole project (also outside `src/`), and keep the 
match case active.

 1. Search and replace all the **"SP_"**. 
 2. Search and replace all the **"sp_"**. 
 3. Search and replace all the **"yasp_"**.
 4. Search and replace the single **"YASP - Yet Another Starter Plugin for WordPress"**
 5. Search and replace all the **"class-sp-"**.
 6. Rename the classes files prefix **"class-sp-"**
 7. Rename the file **"yasp.php"**
 7. Rename the assets files **"yasp.scss"** and **"yasp.js"**

If you did everything correctly, now you should have your project fully renamed but still working exactly as before.

**NOTE:** It's important that you keep the same pattern when you rename strings, to be sure that all inclusion will
continue to work. It's mostly true about classes names

### Folders Structure and primary files

```
+-- _assets                             // The assets files
|   +-- _css                                // The CSS files 
|   +-- _js                                 // The JS files
|   +-- _scss                               // The SCSS files
+-- _includes                           // All the other files
|   +-- _admin                              // The admin files
|   |   +-- _settings                           // The settings page classes
|   |   +-- _views                              // The views rendered on admin side
|   |   +-- class-sp-admin-settings.php         // The core class of the admin side. It mostly manage settings options
|   +-- _classes                            // The non-admin classes of your plugin
|   +-- helpers.php                         // The helper functions
+-- _languages                          // The language files
+-- class-sp-core.php                   // The core class of your plugin
+-- yasp.php                  // The primary file of your plugin, it includes and init everything else.
```

## Development

First of all you should run `npm install` to install all dependencies needed for Gulp tasks. This step isn't required
but it is highly recommended if you want to use an advanced development workflow.

### Gulp tasks

- **default:** Runs all the tasks
- **main-css:** Compiles all the stylesheets files
- **main-js:** Compiles all the scripts files
- **default:** Automatically fires the needed task, depending on the files you edit 


### Add your stuff

At some point you will probably add your stuff to the project (otherwise it will remains a boilerplate forever).

The most interesting places for you are:

- **Admin classes:** All the classes that handle behaviors on admin side are included in the folder `includes/admin`.
Specifically:
    - **Settings pages:** It does exist a class for each settings page (which are actually tabs), they are placed in
     `includes/admin/settings`
    - **Views:** All the HTML views used on the admin side are placed in `includes/admin/views`
- **Generic classes:** All other classes of the plugins are placed in `includes/classes`. They are automatically loaded
when needed
- **Helpers functions:** All the helpers functions are in the file `includes/helpers.php`

The loading of all the files is handled by the class `SP_Core`, specifically by its method `includes()`.

## Plugin options

YASP provides a simplified system to manage your plugin settings, the class `SP_Admin_Settings` handle it.
You can add options extending the class `SP_Admin_Settings_page`.
There are two samples in `includes/admin/settings`.

Each class basically represents a "settings page", which is actually a tab in the settings page of the plugin.
By default, the settings page of the plugin is placed under _Settings_.

### Option types
- title
- separator
- text
- email
- number
- password
- textarea
- select
- multiselect
- radio
- checkbox
- checkboxgroup

### Get options value

You can get the option values saved using the function `sp_get_option( $option_name, $default = '' )`.
It will be of course renamed depending on your specific case.
You can see the function in `includes/helpers.php`.

## License

This project is licensed under the GPL2 License.
