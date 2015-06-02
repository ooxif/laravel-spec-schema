<?php

namespace Ooxif\LaravelSpecSchema;

use Illuminate\Database\Schema\Grammars\Grammar;

interface BuilderInterface
{
    /**
     * @return Grammar
     */
    public function getGrammar();

    /**
     * @param Grammar $grammar
     */
    public function setGrammar(Grammar $grammar);
}