laravel-spec-blueprint
======================

Extends Laravel's Schema/Grammar/Blueprint to describe drivers' specific features.

Install
-------

`composer require "ooxif/laravel-spec-blueprint:1.0.*"`

then
- add `'Ooxif\LaravelSpecSchema\SpecSchemaServiceProvider',` to `providers` in `config/app.php`.
- replace `'Schema' => 'Illuminate\Support\Facades\Schema',` to `'Schema' => 'Ooxif\laravelSpecSchema\Facades\Schema',` in `aliases` of `config/app.php`.


Examples
--------

```php
use Ooxif\LaravelSpecSchema\Blueprint;

Schema::create('table_name', function (Blueprint $table) {
    // Blueprint extends Illuminate\Database\Schema\Blueprint.

    // add a BINARY column if the driver is MySQL,
    // otherwise falls back to default binary(). 
    $table->myBinary('column_name', 8);
    
    // VARBINARY/TINYBLOB/MEDIUMBLOB/LONGBLOB also falls back to default binary().
    $table->myVarBinary('column_name', 16);
    $table->myTinyBlob('column_name');
    $table->myMediumBlob('column_name');
    $table->myLongBlob('column_name');
    
    // TINYTEXT falls back to default text().
    $table->myTinyText('column_name');
    
    // add `collate`
    $table->string('column_name')->collate('utf8_bin');
});
```


Use your own Schema Builder/Grammar/Blueprint classes
----------------------------------------------

```php
class MyMySqlBuilder extends Ooxif\LaravelSpecSchema\MySql\Builder
                  // extends Illuminate\Database\Schema\MySqlBuilder
{
    // your code here.
}

class MyMySqlGrammar extends Ooxif\LaravelSpecSchema\MySql\Grammar
                  // extends Illuminate\Database\Schema\Grammars\MySqlGrammar
{
    // your code here.
}

class MyBlueprint extends Ooxif\LaravelSpecSchema\Blueprint
               // extends Illuminate\Database\Schema\Blueprint
{
    // your code here.
}


// setBuilderClass(string $driverName, string $className)
Schema::setBuilderClass('mysql', 'MyMySqlBuilder');

// setGrammarClass(string $driverName, string $className)
Schema::setGrammarClass('mysql', 'MyMySqlGrammar');

// setBlueprintClass(string $className)
Schema::setBlueprintClass('MyBlueprint');


Schema::create('table_name', function ($table) {
    $table instanceof MyBlueprint; // true
    
    $table->getBuilder() instanceof MyMySqlBuilder; // true
    
    $table->getBuilder()->getGrammer() instanceof MyMySqlGrammar; // true
});
```