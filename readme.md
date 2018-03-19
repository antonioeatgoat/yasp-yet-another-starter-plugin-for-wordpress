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

Here's the folders structure and the primary files:

```
+-- _assets                             // The assets files
|   +-- _css                                // The CSS files 
|   +-- _js                                 // The JS files
|   +-- _scss                               // The SCSS files
+-- _includes                           // All the other files
|   +-- _admin                              // The admin files
|   |   +-- _settings                           // The settings page classes
|   |   +-- _views                              // The views rendered on admin side
|   |   +-- class-st-admin-settings.php         // The core class of the admin side. It mostly manage settings options
|   +-- _classes                            // The non-admin classes of your plugin
|   +-- helpers.php                         // The helper functions
+-- _languages                          // The language files
+-- class-st-core.php                   // The core class of your plugin
+-- starter-plugin.php                  // The primary file of your plugin, it includes and init everything else.
```
### Rename everything

It's assumed that you will rename many parts of the plugin, such as name, slug, language context, files name, etc.

Follow these steps in order to replace all the strings properly.
When you perform the search-and-replace, search for the strings in the whole project (also outside `src/`), and keep the 
match case active.

 1. Search and replace all the **"ST_"**. 
 2. Search and replace all the **"st_"**. 
 3. Search and replace all the **"starter_plugin"**.
 4. Search and replace all the **"starter-plugin"**.
 5. Search and replace all the **"Starter Plugin"** *(basically the name of the plugin)*.
 6. Search and replace all the **"class-st-"**.
 7. Rename the classes files prefix **"class-st-"**
 8. Rename the file **"starter-plugin.php"**
 9. Rename the file **"class-st-core.php"**

If you did everything correctly, now you should have your project fully renamed but still working exactly as before.

**NOTE:** It's important that you keep the same pattern when you rename strings, to be sure that all inclusion will
continue to work. It's mostly true about classes names


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


## Plugin options

YASP provides a simplified system to manage your plugin settings, the class `ST_Admin_Settings` handle it.
You can add options extending the class `ST_Admin_Settings_page`.
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

You can get the option values saved using the function `st_get_option( $option_name, $default = '' )`.
It will be of course renamed depending on your specific case.
You can see the function in `includes/helpers.php`.

## License

This project is licensed under the GPL2 License.