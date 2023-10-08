<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Json;
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
 * @property bool $nsfw
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Topic $topic
 * @property User $user
 * @property Collection|Reply[] $replies
 * @property Collection|Tag[] $tags
 * @property Collection|TopicSticky[] $topic_stickies
 *
 * @package App\Models
 */
class Post extends Model
{
	protected $table = 'post';

	protected $casts = [
		'topic_id' => 'int',
		'user_id' => 'int',
		'score' => 'int',
		'nsfw' => 'bool',
        'content' => 'array'
	];

	protected $fillable = [
		'name',
		'topic_id',
		'user_id',
		'score',
		'content',
		'nsfw'
	];

	public function topic()
	{
		return $this->belongsTo(Topic::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function replies()
	{
		return $this->hasMany(Reply::class);
	}

	public function tags()
	{
		return $this->belongsToMany(Tag::class, 'tag_post')
					->withPivot('id');
	}

    public function scopeSearchTags($query, $tagids)
    {
        $query->whereHas('tags', function ($q) use ($tagids) {
            $q->whereIn('id', $tagids);
        })->get;
    }
	public function topic_stickies()
	{
		return $this->hasMany(TopicSticky::class);
	}
}
