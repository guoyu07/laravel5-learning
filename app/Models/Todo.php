<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Todo
 *
 * @property integer $id
 * @property string $name
 * @property string $tag
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property string $done_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Todo whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Todo whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Todo whereTag($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Todo whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Todo whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Todo whereDoneAt($value)
 * @mixin \Eloquent
 */
class Todo extends Model
{
    //
}
