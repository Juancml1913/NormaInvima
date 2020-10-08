<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use App\Mantenimiento;
use App\Notifications\Alerta;

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
        foreach ($users as $user) {
            $user->notify(new Alerta("Alerta: mantenimiento preventivo", "Probando las alertas"));
        }
    }
}
