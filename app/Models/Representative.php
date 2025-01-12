<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id primary key
 * @property int $company_id key for company tables
 * @property string $name
 * @property string $role
 * @property string $phone
 * @property string $email
 *
 */
class Representative extends Model
{
    use HasFactory;

    protected $table = 'representatives';

    protected $fillable = [
        'company_id',
        'name',
        'role',
        'phone',
        'email',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

}
