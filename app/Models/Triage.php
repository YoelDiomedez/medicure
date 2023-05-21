<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Triage extends Model implements Auditable
{
    use HasFactory, \OwenIt\Auditing\Auditable;

    public function attention()
    {
        return $this->belongsTo(Attention::class)->select(['id', 'patient_id', 'employee_id']);
    }
}
