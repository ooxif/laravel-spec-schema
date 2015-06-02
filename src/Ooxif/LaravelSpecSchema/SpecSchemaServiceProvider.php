<?php

namespace Ooxif\LaravelSpecSchema;

use Illuminate\Contracts\Foundation\Application as ApplicationContract;
use Illuminate\Support\ServiceProvider;

class SpecSchemaServiceProvider extends ServiceProvider
{
    protected $managerClass = 'Ooxif\LaravelSpecSchema\SchemaManager';

    public function register()
    {
        $this->app->singleton('schema', function (ApplicationContract $app) {
            return $this->newSchemaManager($app);
        });
    }

    /**
     * @param ApplicationContract $app
     * @return SchemaManager
     */
    protected function newSchemaManager(ApplicationContract $app)
    {
        $cls = $this->managerClass;

        return new $cls($app);
    }
}