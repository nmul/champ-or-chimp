<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Competition
 * 
 * @property int $id
 * @property string $competition_name
 * @property Carbon $closing_date
 * @property Carbon $finishing_date
 * @property bool $is_active
 * @property int $number_of_events
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Entry[] $entries
 * @property Collection|Event[] $events
 * @property Collection|QuickPick[] $quick_pick
 *
 * @package App\Models
 */
class Competition extends Model
{
	protected $table = 'competition';

	protected $casts = [
		'closing_date' => 'datetime',
		'finishing_date' => 'datetime',
		'is_active' => 'bool',
		'number_of_events' => 'int'
	];

	protected $fillable = [
		'competition_name',
		'closing_date',
		'finishing_date',
		'is_active',
		'number_of_events'
	];

	public function entries()
	{
		return $this->hasMany(Entry::class);
	}

	public function events()
	{
		return $this->belongsToMany(Event::class, 'events_in_competition')
					->withPivot('id')
					->withTimestamps();
	}

	public function quick_pick()
	{
		return $this->hasMany(QuickPick::class);
	}
}
