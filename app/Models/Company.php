<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id primary key
 * @property string $name company name
 * @property string $address company address
 * @property string $phone company phone number
 * @property string $email company email address
 * @property string $ceo company ceo name
 *
 */
class Company extends Model
{
    use HasFactory;

    protected $table = 'companies';

    protected $fillable = [
        'name',
        'address',
        'phone',
        'email',
        'ceo'
    ];

    public function contracts(){
        return $this->hasMany(Contract::class);
    }

    public function representative(){
        return $this->hasMany(Representative::class, 'company_id');
    }
}
