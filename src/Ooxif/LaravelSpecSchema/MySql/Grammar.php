<?php

namespace Ooxif\LaravelSpecSchema\MySql;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Grammars\MySqlGrammar as BaseGrammar;
use Illuminate\Support\Fluent;
use Ooxif\LaravelSpecSchema\GrammarTrait;

class Grammar extends BaseGrammar
{
    use GrammarTrait;

    public function __construct()
    {
        $this->modifiers[] = 'Collate';
    }

    /**
     * @param Fluent $column
     * @return string
     */
    protected function typeMyBinary(Fluent $column)
    {
        return "binary({$column->length})";
    }

    /**
     * @param Fluent $column
     * @return string
     */
    protected function typeMyVarBinary(Fluent $column)
    {
        return "varbinary({$column->length})";
    }

    /**
     * @param Fluent $column
     * @return string
     */
    protected function typeMyTinyBlob(Fluent $column)
    {
        return "tinyblob";
    }

    /**
     * @param Fluent $column
     * @return string
     */
    protected function typeMyMediumBlob(Fluent $column)
    {
        return "mediumblob";
    }

    /**
     * @param Fluent $column
     * @return string
     */
    protected function typeMyLongBlob(Fluent $column)
    {
        return "longblob";
    }

    /**
     * @param Fluent $column
     * @return string
     */
    protected function typeMyTinyText(Fluent $column)
    {
        return "tinytext";
    }
    
    /**
     * @param Blueprint $blueprint
     * @param Fluent $column
     * @return string
     */
    protected function modifyCollate(Blueprint $blueprint, Fluent $column)
    {
        if ($column->collate) {
            return ' collate ' . $column->collate;
        }
    }
}