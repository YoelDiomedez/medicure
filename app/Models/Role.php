<?php

namespace App\Models;

use OwenIt\Auditing\Contracts\Auditable;
use Spatie\Permission\Models\Role as SpatieRoleModel;

class Role extends SpatieRoleModel implements Auditable
{
    use \OwenIt\Auditing\Auditable;
}

