<?php

use Illuminate\Database\Seeder;
use App\Horario;

class HorarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   $horario = new Horario();
        $horario->hora_inicio = "2019-11-29 08:00:00";
        $horario->hora_fin = "2019-11-29 09:30:00";
        $horario->save();

        $horario = new Horario();
        $horario->hora_inicio = "2019-11-29 09:40";
        $horario->hora_fin = "2019-11-29 11:10";
        $horario->save();

        $horario = new Horario();
        $horario->hora_inicio = "2019-11-29 11:20";
        $horario->hora_fin = "2019-11-29 12:50";
        $horario->save();

        $horario = new Horario();
        $horario->hora_inicio = "2019-11-29 14:45";
        $horario->hora_fin = "2019-11-29 16:15";
        $horario->save();

        $horario = new Horario();
        $horario->hora_inicio = "2019-11-29 16:20";
        $horario->hora_fin = "2019-11-29 17:50";
        $horario->save();

        $horario = new Horario();
        $horario->hora_inicio = "2019-11-29 17:55";
        $horario->hora_fin = "2019-11-29 19:25";
        $horario->save();

        $horario = new Horario();
        $horario->hora_inicio = "2019-11-29 19:30";
        $horario->hora_fin = "2019-11-29 21:00";
        $horario->save();
        /*
        $horario = new Horario();
        $horario->hora_inicio = "2019-11-29 08:00:00";
        $horario->hora_fin = "2019-11-29 08:45:00";
        $horario->save();

        $horario = new Horario();
        $horario->hora_inicio = "2019-11-29 08:45";
        $horario->hora_fin = "2019-11-29 09:30";
        $horario->save();

        $horario = new Horario();
        $horario->hora_inicio = "2019-11-29 09:40";
        $horario->hora_fin = "2019-11-29 10:25";
        $horario->save();

        $horario = new Horario();
        $horario->hora_inicio = "2019-11-29 10:25";
        $horario->hora_fin = "2019-11-29 11:10";
        $horario->save();

        $horario = new Horario();
        $horario->hora_inicio = "2019-11-29 11:20";
        $horario->hora_fin = "2019-11-29 12:05";
        $horario->save();

        $horario = new Horario();
        $horario->hora_inicio = "2019-11-29 12:05";
        $horario->hora_fin = "2019-11-29 12:50";
        $horario->save();

        $horario = new Horario();
        $horario->hora_inicio = "2019-11-29 14:45";
        $horario->hora_fin = "2019-11-29 15:30";
        $horario->save();

        $horario = new Horario();
        $horario->hora_inicio = "2019-11-29 15:30";
        $horario->hora_fin = "2019-11-29 16:15";
        $horario->save();

        $horario = new Horario();
        $horario->hora_inicio = "2019-11-29 16:20";
        $horario->hora_fin = "2019-11-29 17:05";
        $horario->save();

        $horario = new Horario();
        $horario->hora_inicio = "2019-11-29 17:05";
        $horario->hora_fin = "2019-11-29 17:50";
        $horario->save();

        $horario = new Horario();
        $horario->hora_inicio = "2019-11-29 17:55";
        $horario->hora_fin = "2019-11-29 18:40";
        $horario->save();

        $horario = new Horario();
        $horario->hora_inicio = "2019-11-29 18:40";
        $horario->hora_fin = "2019-11-29 19:25";
        $horario->save();

        $horario = new Horario();
        $horario->hora_inicio = "2019-11-29 19:30";
        $horario->hora_fin = "2019-11-29 20:15";
        $horario->save();

        $horario = new Horario();
        $horario->hora_inicio = "2019-11-29 20:15";
        $horario->hora_fin = "2019-11-29 21:00";
        $horario->save();
        */
    }
}
