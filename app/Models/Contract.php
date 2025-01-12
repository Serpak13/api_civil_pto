<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id primary key
 * @property int $company_id key for company table
 * @property string $contract_number
 * @property string $contract_type
 * @property Carbon $contract_date
 * @property string $contract_status
 * @property string $payment_status
 *
 */
class Contract extends Model
{
    use HasFactory;
    protected $table = 'contracts';

    protected $fillable = [
        'company_id',
        'contract_number',
        'contract_type',
        'contract_date',
        'contract_status',
        'payment_status',
    ];

    public function company(){
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function buildingObjects(){
        return $this->hasMany(BuildingObject::class, 'contract_id');
    }

    public function acts(){
        return $this->hasMany(Act::class, 'contract_id');
    }
}
