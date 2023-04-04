<?php namespace App\Models\Traits;

trait UuidGenerator
{
    protected static function bootUuidGenerator()
    {
        static::creating(function ($model) {
            $model->uuid = \Ramsey\Uuid\Uuid::uuid4();
        });
    }
}