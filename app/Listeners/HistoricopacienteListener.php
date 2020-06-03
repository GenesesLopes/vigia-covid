<?php

namespace App\Listeners;
use App\Historico;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class HistoricopacienteListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        // dd($event->data);
        Historico::create([
            'paciente_id' => $event->data->paciente_id,
            'users_id' => $event->data->users_id,
            'action' => $event->data->action,
            'data' => $event->data->data
        ]);
    }
}
