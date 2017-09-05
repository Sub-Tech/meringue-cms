# Meringue CMS

## Creating a Plugin

### Getting Started

Create a class called `ExamplePlugin` inside the plugins/YourName/ExamplePlugin folder.

This class must extend `App\Plugin\PluginBase`.

Generate the method stubs from the abstract `PluginBase` class and its associated `PluginInterface` and fill them in as instructed.
Return Types and Method Parameters are provided - it is up to you to decide what to do in the middle!

### Implementing Further Functionality

#### Instances

If your Plugin requires differing content between Blocks, implement the `App\Plugin\InstanceInterface` and fill the method stubs as instructed.

#### Routes

If you wish to set up custom Routes for your Plugin, create a _routes.php_ file in the root folder of your Plugin. 

Do try and use naming schemes that won't collide with any other Plugins.

Routes should be set up as documented here:

https://laravel.com/docs/5.5/routing

#### Crons

If your Plugin requires scheduled functionality, simply implement `App\Plugin\CronInterface` and complete the `schedule()` function as documented here:

https://laravel.com/docs/5.5/scheduling

#### Migrations 

The command to create a new databse migration is:

`php artisan make:migration migration_name --path="path/to/migrations/folder"`

The standard for table names is _vendorName_pluginName_tableName_

Use `php artisan migrate --path="path/to/migrations/folder"` to run the migrations or `php artisan migrate:reset --path="path/to/migrations/folder"` to roll them back.

You could also use `$this->runMigrations("path/to/migrations/folder")` and `$this->rollbackMigrations("path/to/migrations/folder")` inside your Plugin Class to run or rollback your migrations respectively.

Documentation on structuring a migrations file can be found here:

https://laravel.com/docs/5.5/migrations

#### Views

The page for the views folder in your plugin begins at the plugins/ folder; so an example function would be:

```
public function render()
{
    return view('vendorName/pluginName/views/viewName');
}
```

Documentation on views can be found below:

https://laravel.com/docs/5.5/views

#### Modal

#### Admin SideBar