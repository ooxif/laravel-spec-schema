<?php

namespace Ooxif\LaravelSpecSchema;

use Illuminate\Contracts\Foundation\Application as ApplicationContract;
use Illuminate\Database\Schema\Builder as BaseBuilder;

class Builder extends BaseBuilder implements BuilderInterface
{
    use BuilderTrait;
    
    /**
     * @param ApplicationContract $app
     * @param BaseBuilder $base
     */
    public function __construct(ApplicationContract $app, BaseBuilder $base)
    {
        parent::__construct($base->getConnection());
    }
}