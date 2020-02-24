<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'type',
        'params',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

