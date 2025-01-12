<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * @property int $id primary key
 * @property int $building_object_id
 * @property string $name
 * @property string $project_code
 * @property string $project_section
 * @property string $project_stage
 */
class Project extends Model
{
    use HasFactory;
    protected $table = 'projects';

    protected $fillable = [
        'building_object_id',
        'name',
        'project_code',
        'project_section',
        'project_stage'
    ];

    public function buildingObject(){
        return $this->belongsTo(BuildingObject::class, 'building_object_id');
    }

    public function acts(){
        return $this->hasMany(Act::class, 'project_id');
    }
}
