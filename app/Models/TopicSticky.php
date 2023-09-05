<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TopicSticky
 * 
 * @property int $id
 * @property int $post_id
 * @property int $topic_id
 * 
 * @property Post $post
 * @property Topic $topic
 *
 * @package App\Models
 */
class TopicSticky extends Model
{
	protected $table = 'topic_sticky';
	public $timestamps = false;

	protected $casts = [
		'post_id' => 'int',
		'topic_id' => 'int'
	];

	protected $fillable = [
		'post_id',
		'topic_id'
	];

	public function post()
	{
		return $this->belongsTo(Post::class);
	}

	public function topic()
	{
		return $this->belongsTo(Topic::class);
	}
}
