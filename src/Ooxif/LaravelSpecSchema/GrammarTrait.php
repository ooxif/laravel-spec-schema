<?php

namespace Ooxif\LaravelSpecSchema;

use Illuminate\Support\Fluent;

trait GrammarTrait
{
    /**
     * Get the SQL for the column data type.
     *
     * @param Fluent  $column
     * @return string
     */
    protected function getType(Fluent $column)
    {
        $type = $column->type;

        if (is_string($type) && strpos($type, '.') !== false) {
            list($customType, $fallbackType) = explode('.', $type, 2);

            $column->type = method_exists($this, 'type' . ucfirst($customType)) ? $customType : $fallbackType;
        }

        return parent::getType($column);
    }
}