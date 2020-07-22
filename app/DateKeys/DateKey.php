<?php

namespace App\DateKeys;

use App\DateKeys\Date\DateCast;
use App\DateKeys\Key\KeyCast;
use Illuminate\Database\Eloquent\Model;

/**
 * @property \Carbon\Carbon $date
 * @property \App\DateKeys\Key\Key $keys
 */
class DateKey extends Model
{
    public $incrementing = false;
    public $timestamps = false;

    protected $table = 'date_keys';
    protected $fillable = ['date', 'keys'];
    protected $primaryKey = ['date', 'keys'];
    protected $keyType = 'string';
    protected $casts = [
        'date' => DateCast::class,
        'keys' => KeyCast::class,
    ];
}
