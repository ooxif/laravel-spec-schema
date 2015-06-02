<?php

namespace Ooxif\LaravelSpecSchema\Postgres;

use Illuminate\Database\Schema\Grammars\PostgresGrammar as BaseGrammar;
use Ooxif\LaravelSpecSchema\GrammarTrait;

class Grammar extends BaseGrammar
{
    use GrammarTrait;
}