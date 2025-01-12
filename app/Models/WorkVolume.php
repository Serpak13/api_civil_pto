<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * @property int $id primary key
 * @property string $name
 * @property string $description
 * @property float $quantity
 * @property int $act_id key for acts table
 *
 */
class WorkVolume extends Model
{
    use HasFactory;
    protected $table = 'work_volumes';

    protected $fillable = [
        'name',
        'description',
        'quantity',
    ];

    public function act(){
        return $this->belongsTo(Act::class, 'act_id');
    }
}
