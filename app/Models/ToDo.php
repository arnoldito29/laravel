<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class ToDo extends Model
{
    /**
     * @var string
     */
    protected $table = 'to_do';

    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'content',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

