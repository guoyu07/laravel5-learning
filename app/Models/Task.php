<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Task
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Task whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Task whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Task whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Task whereCreatedAt($value)
 * @mixin \Eloquent
 */
class Task extends Model
{
    //
}
