<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;

/**
 * Class User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $role
 * @property Carbon $email_verified_at
 * @property string $password
 * @property string $bio
 * @property string $status
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Collection|Post[] $posts
 * @property Collection|Reply[] $replies
 *
 * @package App\Models
 */
class User extends Authenticatable implements MustVerifyEmail
{

    use Notifiable;

	protected $table = 'users';

	protected $hidden = [
		'password',
		'remember_token'
	];

	protected $fillable = [
		'name',
		'email',
		'email_verified_at',
		'password',
		'bio',
		'status',
		'remember_token',
        'role'
	];

	public function posts()
	{
		return $this->hasMany(Post::class);
	}

    public function postlikes()
    {
        return $this->hasMany(PostLike::class);
    }

	public function replies()
	{
		return $this->hasMany(Reply::class);
	}
}
