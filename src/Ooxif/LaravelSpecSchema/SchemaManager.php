<?php

namespace Ooxif\LaravelSpecSchema;

use BadMethodCallException;
use Closure;
use Illuminate\Contracts\Foundation\Application as ApplicationContract;
use Illuminate\Database\Connection;
use Illuminate\Database\Schema\Grammars\Grammar;

class SchemaManager
{
    /**
     * @var ApplicationContract
     */
    protected $app;

    /**
     * class names which extends Illuminate\Database\SchemaBuilder implements Ooxif\LaravelSpecSchema\BuilderInterface.
     * 
     * @var string[]
     */
    protected $builders = array(
        'default' => 'Ooxif\LaravelSpecSchema\Builder',
        'mysql' => 'Ooxif\LaravelSpecSchema\MySql\Builder',
    );

    /**
     * class names which extends Illuminate\Database\Schema\Grammars\Grammar.
     * 
     * @var string[]
     */
    protected $grammars = array(
        'mysql' => 'Ooxif\LaravelSpecSchema\MySql\Grammar',
        'postgres' => 'Ooxif\LaravelSpecSchema\Postgres\Grammar',
        'sqlite' => 'Ooxif\LaravelSpecSchema\SQLite\Grammar',
        'sqlserver' => 'Ooxif\LaravelSpecSchema\SqlServer\Grammar',
    );

    /**
     * the class name which extends Illuminate\Database\Schema\Blueprint.
     * 
     * @var string
     */
    protected $blueprint = 'Ooxif\LaravelSpecSchema\Blueprint';

    /**
     * @param ApplicationContract $app
     */
    public function __construct(ApplicationContract $app)
    {
        $this->app = $app;
    }

    /**
     * @param string|null $connectionName
     * @return BuilderInterface
     */
    public function createBuilder($connectionName)
    {
        /**
         * @var Connection $connection
         */
        $connection = $this->app['db']->connection($connectionName);

        $driver = $connection->getDriverName();

        $cls = $this->builders[isset($this->builders[$driver]) ? $driver : 'default'];

        $builder = new $cls($this->app, $connection->getSchemaBuilder());

        $this->setGrammarToBuilder($builder);

        $this->setResolverToBuilder($builder);

        return $builder;
    }
    
    protected function setGrammarToBuilder(BuilderInterface $builder)
    {
        $builder->setGrammar($this->createGrammar($builder));
    }
    
    /**
     * @param BuilderInterface $builder
     * @return Grammar
     */
    protected function createGrammar(BuilderInterface $builder)
    {
        $driverName = $builder->getConnection()->getDriverName();

        if (!isset($this->grammars[$driverName])) {
            throw new BadMethodCallException("Grammar class for the driver '{$driverName}' is not defined.'");
        }

        $cls = $this->grammars[$driverName];

        return new $cls();
    }

    /**
     * @param BuilderInterface $builder
     */
    protected function setResolverToBuilder(BuilderInterface $builder)
    {
        $builder->blueprintResolver(function ($table, Closure $callback = null) use ($builder) {
            return $this->createBlueprint($builder, $table, $callback);
        });
    }
    
    /**
     * @param BuilderInterface $builder
     * @param string $table
     * @param Closure|null $callback
     * @return Blueprint
     */
    protected function createBlueprint(BuilderInterface $builder, $table, Closure $callback = null)
    {
        $cls = $this->blueprint;
        
        return new $cls($builder, $table, $callback);
    }

    /**
     * @param string $driverName 'default', 'mysql', 'postgres', ...
     * @param string $className the class name which extends Illuminate\Database\Schema\Builder implements Ooxif\LaravelSpecSchema\BuilderInterface. 
     */
    public function setBuilderClass($driverName, $className)
    {
        $this->builders[$driverName] = $className;
    }

    /**
     * @param string $driverName
     * @return string|null
     */
    public function getBuilderClass($driverName)
    {
        return isset($this->builders[$driverName]) ? $this->builders[$driverName] : null;
    }

    /**
     * @param string $driverName 'default', 'mysql', 'postgres', ...
     * @param string $className the class name which extends Illuminate\Database\Schema\Grammars\Grammar.
     */
    public function setGrammarClass($driverName, $className)
    {
        $this->grammars[$driverName] = $className;
    }

    /**
     * @param string $driverName
     * @return string|null
     */
    public function getGrammarClass($driverName)
    {
        return isset($this->grammars[$driverName]) ? $this->grammars[$driverName] : null;
    }

    /**
     * @param string $className the class name which extends Ooxif\LaravelSpecSchema\Blueprint.
     */
    public function setBlueprintClass($className)
    {
        $this->blueprint = $className;
    }

    /**
     * @return string
     */
    public function getBlueprintClass()
    {
        return $this->blueprint;
    }
}