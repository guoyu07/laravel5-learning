<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Laracasts\Presenter\PresentableTrait;
use Venturecraft\Revisionable\RevisionableTrait;
use Smartisan\Follow\FollowTrait;
use App\Jobs\SendActivateMail;
use App\Models\Traits\UserRememberTokenHelper;
use App\Models\Traits\UserSocialiteHelper;
use App\Models\Traits\UserAvatarHelper;
use Carbon\Carbon;
use Cache;

/**
 * App\Models\User
 *
 * @property integer $id
 * @property integer $github_id
 * @property string $github_url
 * @property string $email
 * @property string $name
 * @property string $login_token
 * @property string $remember_token
 * @property string $is_banned
 * @property string $image_url
 * @property integer $topic_count
 * @property integer $reply_count
 * @property integer $follower_count
 * @property string $city
 * @property string $company
 * @property string $twitter_account
 * @property string $personal_website
 * @property string $introduction
 * @property string $certification
 * @property integer $notification_count
 * @property string $github_name
 * @property string $real_name
 * @property string $linkedin
 * @property string $payment_qrcode
 * @property string $wechat_qrcode
 * @property string $avatar
 * @property string $login_qr
 * @property string $wechat_openid
 * @property string $wechat_unionid
 * @property string $weibo_name
 * @property string $weibo_link
 * @property boolean $verified
 * @property string $verification_token
 * @property string $email_notify_enabled
 * @property string $register_source
 * @property string $last_actived_at
 * @property \Carbon\Carbon $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Topic[] $topics
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Reply[] $replies
 * @property-read \Illuminate\Database\Eloquent\Collection|\Venturecraft\Revisionable\Revision[] $revisionHistory
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Role[] $roles
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $followers
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $followings
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereGithubId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereGithubUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereLoginToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereIsBanned($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereImageUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereTopicCount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereReplyCount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereFollowerCount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereCity($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereCompany($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereTwitterAccount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User wherePersonalWebsite($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereIntroduction($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereCertification($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereNotificationCount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereGithubName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereRealName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereLinkedin($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User wherePaymentQrcode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereWechatQrcode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereAvatar($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereLoginQr($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereWechatOpenid($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereWechatUnionid($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereWeiboName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereWeiboLink($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereVerified($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereVerificationToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereEmailNotifyEnabled($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereRegisterSource($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereLastActivedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User isRole($role)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User recent()
 * @mixin \Eloquent
 */
class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract
{
    use UserRememberTokenHelper,UserSocialiteHelper,UserAvatarHelper;
    use PresentableTrait;
    public $presenter = 'Phphub\Presenters\UserPresenter';

    // For admin log
    use RevisionableTrait;
    protected $keepRevisionOf = [
        'is_banned'
    ];

    use EntrustUserTrait {
        restore as private restoreEntrust;
        EntrustUserTrait::can as may;
    }
    use SoftDeletes { restore as private restoreSoftDelete; }
    use FollowTrait;
    protected $dates = ['deleted_at'];

    protected $table   = 'users';
    protected $guarded = ['id', 'is_banned'];

    public static function boot()
    {
        parent::boot();

        static::created(function ($user) {
            $driver = $user['github_id'] ? 'github' : 'wechat';
            SiteStatus::newUser($driver);

            dispatch(new SendActivateMail($user));
        });

        static::deleted(function ($user) {
            \Artisan::call('phphub:clear-user-data', ['user_id' => $user->id]);
        });
    }

    public function scopeIsRole($query, $role)
    {
        return $query->whereHas('roles', function ($query) use ($role) {
                $query->where('name', $role);
            }
        );
    }
    public static function hallOfFamesUsers()
    {
        $data = Cache::remember('phphub_hall_of_fames', 60, function(){
            return User::isRole('HallOfFame')->orderBy('last_actived_at', 'desc')->get();
        });
        return $data;
    }

    /**
     * For EntrustUserTrait and SoftDeletes conflict
     */
    public function restore()
    {
        $this->restoreEntrust();
        $this->restoreSoftDelete();
    }

    public function votedTopics()
    {
        return $this->morphedByMany(Topic::class, 'votable', 'votes')->withPivot('created_at');
    }

    public function topics()
    {
        return $this->hasMany(Topic::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class)->recent()->with('topic', 'fromUser')->paginate(20);
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function getIntroductionAttribute($value)
    {
        return str_limit($value, 68);
    }

    public function getPersonalWebsiteAttribute($value)
    {
        return str_replace(['https://', 'http://'], '', $value);
    }

    /**
     * ----------------------------------------
     * UserInterface
     * ----------------------------------------
     */

    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function recordLastActivedAt()
    {
        $now = Carbon::now()->toDateTimeString();

        $update_key = config('phphub.actived_time_for_update');
        $update_data = Cache::get($update_key);
        $update_data[$this->id] = $now;
        Cache::forever($update_key, $update_data);

        $show_key = config('phphub.actived_time_data');
        $show_data = Cache::get($show_key);
        $show_data[$this->id] = $now;
        Cache::forever($show_key, $show_data);
    }
}
