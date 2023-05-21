<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    // Dashboard
        Permission::create(['name' => 'home index']);
        Permission::create(['name' => 'home triages']);
        Permission::create(['name' => 'home attentions']);

    // Historial Médico y reportes PDF Historia Clínica y Receta Médica
        Permission::create(['name' => 'histories index']);
        Permission::create(['name' => 'histories record']);
        Permission::create(['name' => 'histories prescription']);

    // Atenciones    
        Permission::create(['name' => 'attentions index']);
        Permission::create(['name' => 'attentions store']);
        Permission::create(['name' => 'attentions update']);
        Permission::create(['name' => 'attentions destroy']);

    // Pacientes
        Permission::create(['name' => 'patients index']);
        Permission::create(['name' => 'patients store']);
        Permission::create(['name' => 'patients update']);
        Permission::create(['name' => 'patients destroy']);
        Permission::create(['name' => 'patients get']);
        Permission::create(['name' => 'patients show']);

    // Triajes
        Permission::create(['name' => 'triages index']);
        Permission::create(['name' => 'triages update']);

    // Historias Clínicas
        Permission::create(['name' => 'records index']);
        Permission::create(['name' => 'records update']);

    // Informes Quirúrgicos
        Permission::create(['name' => 'surgeries index']);
        Permission::create(['name' => 'surgeries store']);            
        Permission::create(['name' => 'surgeries show']);
        Permission::create(['name' => 'surgeries update']);
        Permission::create(['name' => 'surgeries destroy']);

    // Informes de Laboratoriales
        Permission::create(['name' => 'labs index']);
        Permission::create(['name' => 'labs store']);            
        Permission::create(['name' => 'labs show']);
        Permission::create(['name' => 'labs update']);
        Permission::create(['name' => 'labs destroy']);

    // Accesos
        Permission::create(['name' => 'roles index']);
        Permission::create(['name' => 'roles store']);
        Permission::create(['name' => 'roles update']);
        Permission::create(['name' => 'roles destroy']);
        Permission::create(['name' => 'roles get']);
        Permission::create(['name' => 'roles show']);

    // Servicios
        Permission::create(['name' => 'services index']);
        Permission::create(['name' => 'services store']);
        Permission::create(['name' => 'services update']);
        Permission::create(['name' => 'services destroy']);
        Permission::create(['name' => 'services get']);
        Permission::create(['name' => 'services show']);

    // Diagnósticos
        Permission::create(['name' => 'diagnoses index']);
        Permission::create(['name' => 'diagnoses store']);
        Permission::create(['name' => 'diagnoses update']);
        Permission::create(['name' => 'diagnoses destroy']);
        Permission::create(['name' => 'diagnoses get']);
        Permission::create(['name' => 'diagnoses show']);        
        
    // Especialistas
        Permission::create(['name' => 'users index']);
        Permission::create(['name' => 'users store']);
        Permission::create(['name' => 'users update']);
        Permission::create(['name' => 'users destroy']);
        Permission::create(['name' => 'users get']);
        Permission::create(['name' => 'users show']);  
    }
}
