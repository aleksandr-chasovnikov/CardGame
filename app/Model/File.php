<?php

namespace App\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @property integer $id
 * @property string  $path
 * @property integer $owner_id
 * @property string  $owner_type
 * @property boolean $seen
 * @property string  $price
 *
 * @property Carbon  $created_at
 * @property Carbon  $updated_at
 * @property Carbon  $deleted_at
 */
class File extends BaseModel
{
    const TABLE_NAME = 'files';

    /**
     * @var string
     */
    protected $table = self::TABLE_NAME;

    /**
     * Атрибуты, которые должны быть преобразованы в даты.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * Атрибуты, для которых запрещено массовое назначение.
     *
     * @var array
     */
    protected $guarded = [];
}
