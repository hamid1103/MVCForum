<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Post
 * 
 * @property int $id
 * @property string $name
 * @property int $topic_id
 * @property int $user_id
 * @property int $score
 * @property string $content
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Topic $topic
 * @property Collection|Reply[] $replies
 *
 * @package App\Models
 */
class Post extends Model
{
	protected $table = 'post';

	protected $casts = [
		'topic_id' => 'int',
		'user_id' => 'int',
		'score' => 'int'
	];

	protected $fillable = [
		'name',
		'topic_id',
		'user_id',
		'score',
		'content'
	];

	public function topic()
	{
		return $this->belongsTo(Topic::class);
	}

	public function replies()
	{
		return $this->hasMany(Reply::class);
	}
}
