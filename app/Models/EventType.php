<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EventType
 * 
 * @property int $id
 * @property string $name
 * @property int $scoring_scheme_id
 * @property int $how_many_placed
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property ScoringScheme $scoring_scheme
 * @property Collection|Event[] $events
 *
 * @package App\Models
 */
class EventType extends Model
{
	protected $table = 'event_type';

	protected $casts = [
		'scoring_scheme_id' => 'int',
		'how_many_placed' => 'int'
	];

	protected $fillable = [
		'name',
		'scoring_scheme_id',
		'how_many_placed'
	];

	public function scoring_scheme()
	{
		return $this->belongsTo(ScoringScheme::class);
	}

	public function events()
	{
		return $this->hasMany(Event::class);
	}
}
