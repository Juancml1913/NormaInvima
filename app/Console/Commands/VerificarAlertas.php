<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use App\Mantenimiento;
use App\Notifications\Alerta;
use Illuminate\Support\Carbon;

class VerificarAlertas extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'verificar:alertas';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Compara la fecha de hoy con la de la alerta.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        
        $users=User::where('estado',1)->get();
        $carbon = new Carbon();
        $mantenimientos=Mantenimiento::select('instalaciones_fisicas.descripcion',
        'mantenimientos.tipo')
        ->join('instalaciones_fisicas', 'instalaciones_fisicas.id', 'mantenimientos.id_instalacion')
        ->where([['mantenimientos.tipo',1],['mantenimientos.fecha_proxima',$carbon->toDateString()]])->get();
        foreach ($mantenimientos as $mantenimiento) {
            foreach ($users as $user) {
                $user->notify(new Alerta("Alerta: mantenimiento preventivo", "Mantenimiento programado para la instalación: ".$mantenimiento->descripcion));
            }            
        }
        //User::find(3)->first()->notify(new Alerta("Alerta: mantenimiento preventivo", "Mantenimiento programado para la instalación: ".$mantenimiento->descripcion));    
    }
}
