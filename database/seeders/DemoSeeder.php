<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Patient;
use App\Models\Service;
use App\Models\Diagnosis;
use App\Models\Attention;
use App\Models\Triage;
use App\Models\Record;
use App\Models\Prescription;
use App\Models\Surgery;
use App\Models\Lab;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cleans up report files generated
        $storage = Storage::disk(config('app.disk'));

        foreach($storage->files($path='', $recursive=false) as $file) {
            $storage->delete($file);
        }
        
        // Gets all permissions via Gate::before rule; see AuthServiceProvider
        $admin  = Role::create(['name' => 'Super Admin']);

        $email = 'yoeldiomedez@gmail.com';

        $patient = Patient::factory()
        ->create([
            'surnames'       => 'Romero Almonte',
            'names'          => 'Yoel Diomedez',
            'birthdate'      => '1995-10-06',
            'gender'         => 'M',
            'marital_status' => 'S',
            'document_type'  => 'DNI',
            'document_numb'  => '76299297',
            'profession'     => 'Ingeniero de Sistemas',
            'email'          => $email,
        ]);

        $user = User::factory()
        ->for($patient)
        ->create([
            'cmp'       => '239545',
            'position'  => 'Analista Programador de Sistemas',
            'specialty' => 'Desarrollador de Sistemas de Información',
            'email'     => $email,
        ]);

        $user->assignRole($admin);

        // Sevices and Diagnoses sample 
        $services  = Service::factory()->count(100)->create();
        $diagnoses = Diagnosis::factory()->count(100)->create();

        // Employees sample
        $expert  = Role::create(['name' => 'Médico']);
        $expert->syncPermissions([
            1, 2, 3,            // Dashboard
            5, 6,               // Reportes PDF Historia Clínica y Receta Médica
            17, 18, 19, 20,     // Triajes y Historias Clínicas
            47                  // Diagnósticos
        ]);

        $employees = Patient::factory()->count(24)->create();

        foreach ($employees as $employee) {
            $user = User::factory()
            ->for($employee)
            ->create([
                'email' => $employee->email,
            ]);
            $user->assignRole($expert);
        }

        // Patients nursed with some Surgery and Lab report sample
        $patients  = Patient::factory()->count(50)->create();

        foreach ($patients as $patient) {
            $service   = Service::inRandomOrder()->first();
            $attention = Attention::factory()->for($patient)->create([
                'service_id'  => $service->id,
                'user_id'     => User::where('email', $email)->first()->id,
                'employee_id' => User::where('email', '<>', $email)->inRandomOrder()->first()->id,
                'amount'      => $service->amount,
            ]);

            $triage    = Triage::factory()->for($attention)->create();
            $record    = Record::factory()->for($attention)->create();

            $diagnoses = Diagnosis::select('id')
                                ->inRandomOrder()
                                ->limit(fake()->numberBetween(1, 3))
                                ->get();

            $DxsAndTypes = array();
            foreach ($diagnoses as $diagnosis) {
                $DxsAndTypes[$diagnosis->id] = array('type' => fake()->randomElement(['P', 'D', 'R']));
            }
            $record->diagnoses()->sync($DxsAndTypes);

            Prescription::factory()->count(fake()->numberBetween(2, 5))->for($attention)->create();
            
            $attention->status = 'D';
            $attention->save();

            if (fake()->boolean()) {
                $surgery = Surgery::factory()->for($patient)->create([
                    'pre_diagnosis_id'  => Diagnosis::inRandomOrder()->first()->id,
                    'post_diagnosis_id' => Diagnosis::inRandomOrder()->first()->id,
                ]);
                $surgery->users()->sync(
                    User::where('email', '<>', $email)
                    ->inRandomOrder()
                    ->limit(fake()->numberBetween(2, 5))
                    ->get()
                );
    
                Lab::factory()->for($patient)->create([
                    'service_id' => $service->id,
                    'user_id'    => User::where('email', '<>', $email)->inRandomOrder()->first()->id,
                    'amount'     => $service->amount,
                ]);  
            }
        }

        // Patients admitted to Triage and some Triaged sample
        $patients  = Patient::factory()->count(25)->create();

        foreach ($patients as $patient) {
            $service   = Service::inRandomOrder()->first();
            $attention = Attention::factory()->for($patient)->create([
                'service_id'  => $service->id,
                'user_id'     => User::where('email', $email)->first()->id,
                'employee_id' => User::where('email', '<>', $email)->inRandomOrder()->first()->id,
                'amount'      => $service->amount,
            ]);

            $triage = Triage::factory()->for($attention)->create();
            $record = Record::factory()->for($attention)->create();

            if (fake()->boolean()) {
                $attention->status = 'A';
                $attention->save();
            }
        }
    }
}
