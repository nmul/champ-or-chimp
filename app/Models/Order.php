<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
 
class Order extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'orders';

    public $incrementing = false;

    protected $fillable = [
		'amount_paid_cents',
		'number_of_forms',
    'user_id',
    'created_at',
    'updated_at',
    'order_number',
	];
}