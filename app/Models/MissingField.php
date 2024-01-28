<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MissingField
 * 
 * @property int $id
 * @property int $entry_id
 * @property int $event_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Entry $entry
 * @property Event $event
 *
 * @package App\Models
 */
class MissingField extends Model
{
	protected $table = 'missing_fields';

	protected $casts = [
		'entry_id' => 'int',
		'event_id' => 'int'
	];

	protected $fillable = [
		'entry_id',
		'event_id'
	];

	public function entry()
	{
		return $this->belongsTo(Entry::class);
	}

	public function event()
	{
		return $this->belongsTo(Event::class);
	}
}
