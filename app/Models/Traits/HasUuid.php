<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait HasUuid
{
    public function getIncrementing()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }

    public static function bootHasUuid()
    {
        $assignUuid = function (Model $model) {
            $key = $model->primaryKey;
            $model->$key = $model->$key ?? Str::uuid()->toString();
        };

        static::creating($assignUuid);
    }
}
