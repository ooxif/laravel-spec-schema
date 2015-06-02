<?php

namespace Ooxif\LaravelSpecSchema;

use Closure;
use Illuminate\Database\Schema\Blueprint as BaseBlueprint;

class Blueprint extends BaseBlueprint
{
    use MySql\BlueprintTrait, Postgres\BlueprintTrait, SQLite\BlueprintTrait, SqlServer\BlueprintTrait;

    /**
     * @var BuilderInterface|Builder
     */
    protected $builder;
    
    public function __construct(BuilderInterface $builder, $table, Closure $callback = null)
    {
        $this->builder = $builder;

        parent::__construct($table, $callback);
    }

    /**
     * @return Builder|BuilderInterface
     */
    public function getBuilder()
    {
        return $this->builder;
    }
    
    /**
     * @return string
     */
    public function getDriverName()
    {
        return $this->builder->getConnection()->getDriverName();
    }

    /**
     * @return bool
     */
    public function isMySql()
    {
        return $this->getDriverName() === 'mysql';
    }

    /**
     * @return bool
     */
    public function isPostgres()
    {
        return $this->getDriverName() === 'postgres';
    }

    /**
     * @return bool
     */
    public function isSQLite()
    {
        return $this->getDriverName() === 'sqlite';
    }

    /**
     * @return bool
     */
    public function isSqlServer()
    {
        return $this->getDriverName() === 'sqlserver';
    }
}