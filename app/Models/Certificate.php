<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id primary key
 * @property string $name name of certificate
 * @property string $code certificate code
 * @property Carbon $date_start
 * @property Carbon $date_end
 * @property string $description about this certificate
 */
class Certificate extends Model
{
    use HasFactory;

    protected $table = 'certificates';

    protected $fillable = [
        'name',
        'code',
        'date_start',
        'date_end',
        'description',
    ];

    public function acts(){
        return $this->belongsToMany(Act::class, 'act_certificate');
    }
}
