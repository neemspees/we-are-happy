<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use DateTime;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property DateTime $created_at
 *
 * @property User $user
 */
class VoteCast extends Model
{
    use HasUuid;

    public $timestamps = false;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
