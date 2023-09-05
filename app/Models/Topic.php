<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Enums\TopicType;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Topic
 *
 * @property int $id
 * @property string $name
 * @property int $category_id
 * @property string $description
 * @property bool $nsfw
 * @property string $type
 *
 * @property Category $category
 * @property Collection|Post[] $posts
 * @property Collection|TopicSticky[] $topic_stickies
 *
 * @package App\Models
 */
class Topic extends Model
{
	protected $table = 'topics';
	public $timestamps = false;

	protected $casts = [
		'category_id' => 'int',
		'nsfw' => 'bool',
        'type'=>TopicType::class
	];

	protected $fillable = [
		'name',
		'category_id',
		'description',
		'nsfw',
		'type'
	];

	public function category()
	{
		return $this->belongsTo(Category::class);
	}

	public function posts()
	{
		return $this->hasMany(Post::class);
	}

	public function topic_stickies()
	{
		return $this->hasMany(TopicSticky::class);
	}

}
