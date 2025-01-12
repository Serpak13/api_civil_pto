<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * @property int $id primary key
 * @property string $name
 * @property string $code_scheme
 * @property string $description
 * @property int $act_id key for table acts
 */
class ExecutiveScheme extends Model
{
    use HasFactory;

    protected $table = 'executive_schemes';

    protected $fillable = [
        'name',
        'code_scheme',
        'description',
        'act_id'
        ];

    public function act(){
        return $this->belongsTo(Act::class, 'act_id');
    }
}
