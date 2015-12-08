<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Article extends Model {

	/**
	 * fillable fields (mass assignable fields)
	 * @var array
	 */
	protected $fillable = [
		'title',
		'published_at',
		'user_id',
		'photo',
		'vote_count'  // temporary 
	];

	/**
	 * Dates that should be treated as Carbon instances
	 * @var array
	 */
	

    public function scopeSearch($query, $search)
    {
    	return  $query->where(function($query) use ($search){
           	$query->where('title','LIKE',"%$search%");
           });
    }

	/**
	 * An article is owned by a user
	 * 
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user()
	{
		return $this->belongsTo('App\User');
	}

	/**
	 * Get the tags associated with the given article
	 *
	 * @return \Illuminate\Datebase\Eloquent\Relations\BelongsToMany
	 */
	public function tags()
	{
		return $this->belongsToMany('App\Tag')->withTimestamps();
	}

	public function getTagListAttribute()
	{
		return $this->tags->lists('id')->all();
	} 
    

    public function votes()
    {
        return $this->morphMany('App\Vote', 'votable');
    }

    public function replies()
    {
        return $this->hasMany('App\Reply');
    }
    //Article::whose搜到 scope 与query有关
    public function scopeWhose($query, $user_id)
    {
        return $query->where('user_id', '=', $user_id);
    }
    //查找最近发布
    public function scopeRecent($query)
    {
        return $query->orderBy('created_at', 'desc');
    }
}
