<?php

namespace Modules\CardGame\Http\Entities;

use App\Model\BaseModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property integer $id
 * @property string  $name
 * @property string  $avatar
 * @property boolean $seen
 * @property string  $description
 * @property string  $full_description
 *
 * @property Carbon  $deleted_at
 */
class Ability extends BaseModel
{
    use SoftDeletes;

    const TABLE_NAME = 'abilities';

    /**
     * @var string
     */
    protected $table = self::TABLE_NAME;

    public $timestamps = false;

    /**
     * Атрибуты, для которых запрещено массовое назначение.
     *
     * @var array
     */
    protected $guarded = [];
}
