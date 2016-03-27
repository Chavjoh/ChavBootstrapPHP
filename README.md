# ChavBootstrapPHP
MVC Bootstrap with Smarty template system.

## Requirements

* PHP 7+
* Composer

## How it works

```
http://www.example.com/product/section/4/.../...
                          |       |    |  |   |
                          |       |    ↓  ↓   ↓
                          |       | Parameters (stored in the controller)
                          |       | Can be accessed by $this->arguments[position]
                          |       ↓
                          |    Method -> ProductController::section()
                          ↓
                     Controller -> ProductController::__construct()
```
But wait ! There's more ! You can change the method position by overwriting `Controller::getMethodPosition()`. Here's an example for a forum (where `getMethodPosition` return 1 instead of 0):
```
                             Parameters
                             ↑         ↑
                             |         |
http://www.example.com/forum/4/subject/2/
                          |       ↓
                          |    Method -> ProductController::section()
                          ↓
                     Controller -> ProductController::__construct()
```

## How to use it

Clone this repository in your Apache folder, launch it and have fun ! You can configure the website with `app/configuration.xml` file.

Presently, two pages are configured:
* Home (`Controller\HomeController` with `public/template/home.tpl` template)
* About us (`Controller\AboutController` with `public/template/about.tpl` template)

To create a new page, create a new Controller with an associated template and make a link in the `public/template/design.tpl` file.

One other page is configured for management purpose:
* Error (`Controller\ErrorController` with `public/template/error.tpl` template)

A login system is partially implemented in `User\Login`. The user credentials is defined by `Core\AccessLevel`. Each controller can indicate which AccessLevel is needed to access it.

To access the database (after having put the credentials in the XML configuration file) you can simply do something like:
```
$DB = Database::getInstance();
$query = $DB->prepare("TODO");
$query->execute(array(
	$param1, 
	$param2
));
```

All images, styles and scripts are in `public/` folder and the design with all pages templates are in `public/template`.

## Technologies

* [Smarty 3.1](http://www.smarty.net/)

## Feedback

Don't hesitate to fork this project, improve it and make a pull request.

## License

This project is under Apache 2.0 License.
