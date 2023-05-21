<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Surgery extends Model implements Auditable
{
    use HasFactory, \OwenIt\Auditing\Auditable;

    public function patient()
    {
        return $this->belongsTo(Patient::class)
                    ->withTrashed();
    }

    public function preDiagnosis()
    {
        return $this->belongsTo(Diagnosis::class, 'pre_diagnosis_id')
                    ->withTrashed();
    }

    public function postDiagnosis()
    {
        return $this->belongsTo(Diagnosis::class, 'post_diagnosis_id')
                    ->withTrashed();
    }

    public function users()
    {
        return $this->belongsToMany(User::class)
                    ->select('user_id','patient_id', 'position', 'specialty', 'cmp', 'rne')
                    ->withTrashed();
    }
}
