<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id primary key
 * @property int $contract_id key for contracts table
 * @property string $address building object address
 */
class BuildingObject extends Model
{
    use HasFactory;

    protected $table = 'building_objects';
    protected $fillable = [
        'contract_id',
        'address',
    ];

    public function contract(){
        return $this->belongsTo(Contract::class, 'contract_id');
    }

    public function projects(){
        return $this->hasMany(Project::class, 'building_object_id');
    }

    public function acts(){
        return $this->belongsToMany(Act::class, 'act_objects', 'object_id', 'act_id');
    }
}
