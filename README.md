# laravel-knockout-views
Provides a system for dynamically building a modularized knockout.js application in a way that works with
Laravel's Blade templating and views system.

A global view model which serves as an extensible application foundation is declared as 'App', and can be found 
<i>[here](https://github.com/zawntech/laravel-knockout-views/blob/master/views/knockout-app.blade.php)</i>.

```js
// The global view model is declared as App
var App = new KnockoutApp();
```

## Installation

Install to your laravel project via composer:
```
composer require zawntech/laravel-knockout-views
```

## Configuration
Add the service provider and alias to your <i>config/app.php</i>
```php
$providers = [
    ...
    Zawntech\Laravel\KnockoutViews\KnockoutServiceProvider::class
];

$aliases = [
    ... 
    'Knockout' => Zawntech\Laravel\KnockoutViews\KnockoutFacade::class
];
```

## Usage

To use this system, you must:
* have the [knockout.js](http://knockoutjs.com) library included in your application
* call the Knockout::renderModules() function in your template

Then in your views, you can define as many modules as is needed by your application by wrapping the 
modules in <i>Knockout::startModule()</i> and <i>Knockout::stopModule()</i> PHP functions.

##### Example module:
<i>/public/views/todoList.blade.php</i>
```html
<!-- HTML with data bindings -->
<div data-bind="if: todoListView.active">
    <h1 data-bind="text: todoListView.name">
    <ul data-bind="foreach: todoListView.todos">
        <div data-bind="name"></div>
        ...
    </ul>
</div>
```
```php
<?php Knockout::startModule(); ?>
<script>
// Extend App with a model to serve our view.
App.todoListView = {
    active: ko.observable(true),
    name: ko.observable('My Todo List'),
    todos: ko.observableArray( {!! $todos !!} )
};
</script>
<?php Knockout::endModule(); ?>
```

The above code will render the HTML in the appropriate location as per usual with Blade templates. The 
start and end module functions buffer the <script>...</script> tags into an internal array, allowing them 
to be rendered later.

#### Render ViewModels
Your application must have the [knockout.js](http://knockoutjs.com) library 
included as a part of your application's build file (or at least included
independently).

In your layout file encapsulating your main HTML and app.js file, we need to add 
the call the <strong>Knockout::render()</strong> function <i>after</i> our page '
javascript has been loaded, for example:

```html
<html>
    @yield('head')
    <body>
    
    @yield('content')
    
    <!-- Main app.js file -->
    <script src="{{ url('js/app.js') }}"></script>
    
    <!-- Render the main App variable and any registered view model modules. -->
    {!! Knockout::render() !!}
    </body>
</html>
```

The Knockout::render() function:
* prints the main App knockout view model
* prints each module
* finally, applies bindings on the constructed App object

```js
<script>
// Declare the main view model.
var App = new KnockoutApp();

// Extend the main view model with our modules.
App.someModuleA = { ... }
App.someModuleB = { ... }
App.someModuleC = { ... }

// Apply bindings on the final view model.
ko.applyBindings(App);
</script>
```