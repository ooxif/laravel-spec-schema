<?php

namespace Ooxif\LaravelSpecSchema\MySql;

use Illuminate\Contracts\Foundation\Application as ApplicationContract;
use Illuminate\Database\Schema\MySqlBuilder as BaseBuilder;
use Ooxif\LaravelSpecSchema\BuilderInterface;
use Ooxif\LaravelSpecSchema\BuilderTrait;

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