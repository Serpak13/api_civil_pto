<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id primary key
 * @property Carbon $date_start start work
 * @property Carbon $date_end end work
 * @property int $project_id key for projects table
 * @property int $contract_id key for contracts table
 *
 */
class Act extends Model
{
    use HasFactory;

    protected $table = 'acts';

    protected $fillable = [
        'date_start',
        'date_end',
        'project_id',
        'contract_id'
    ];

    public function buildingObjects()
    {
        return $this->belongsToMany(BuildingObject::class, 'act_object', 'act_id', 'object_id');
    }

    public function certifications()
    {
        return $this->belongsToMany(Certificate::class, 'act_certificate');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function contract()
    {
        return $this->belongsTo(Contract::class, 'contract_id');
    }

    public function workVolume()
    {
        return $this->hasOne(WorkVolume::class, 'act_id');
    }

    public function executiveScheme()
    {
        return $this->hasMany(ExecutiveScheme::class, 'act_id');
    }


}
