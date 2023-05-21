<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Attention extends Model implements Auditable
{
    use HasFactory, \OwenIt\Auditing\Auditable;

    protected $primaryKey = 'id';

    public function triage()
    {
        return $this->hasOne(Triage::class);
    }

    public function record()
    {
        return $this->hasOne(Record::class);
    }

    public function prescriptions()
    {
        return $this->hasMany(Prescription::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class)
                    ->withTrashed();
    }

    public function service()
    {
        return $this->belongsTo(Service::class)
                    ->withTrashed();
    }

    public function user()
    {
        return $this->belongsTo(User::class)
                    ->select(['id', 'patient_id'])
                    ->withTrashed();
    }

    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id')
                    ->select(['id', 'patient_id', 'specialty', 'cmp', 'rne'])
                    ->withTrashed();
    }
}
