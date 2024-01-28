<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EventsInCompetition
 * 
 * @property int $id
 * @property int $event_id
 * @property int $competition_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Competition $competition
 * @property Event $event
 *
 * @package App\Models
 */
class EventsInCompetition extends Model
{
	protected $table = 'events_in_competition';

	protected $casts = [
		'event_id' => 'int',
		'competition_id' => 'int'
	];

	protected $fillable = [
		'event_id',
		'competition_id'
	];

	public function competition()
	{
		return $this->belongsTo(Competition::class);
	}

	public function event()
	{
		return $this->belongsTo(Event::class);
	}
}
