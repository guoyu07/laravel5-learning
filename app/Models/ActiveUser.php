<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cache;

/**
 * App\Models\ActiveUser
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $topic_count
 * @property integer $reply_count
 * @property integer $weight
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ActiveUser whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ActiveUser whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ActiveUser whereTopicCount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ActiveUser whereReplyCount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ActiveUser whereWeight($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ActiveUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ActiveUser whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ActiveUser extends Model
{
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function fetchAll()
    {
        $data = Cache::remember('phphub_active_users', 30, function(){
            return self::with('user')
                       ->orderBy('weight', 'DESC')
                       ->limit(8)
                       ->get()
                       ->pluck('user');
        });

        return $data;

    }
}
