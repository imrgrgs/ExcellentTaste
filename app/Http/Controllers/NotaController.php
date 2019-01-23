<?php

namespace App\Http\Controllers;

use App\Reservation;
use Barryvdh\DomPDF\Facade as PDF;

class NotaController extends Controller
{
    public function generate(Reservation $reservation)
    {
        $data = [
            'reservation' => $reservation
        ];
        if (!file_exists(storage_path('app/public/notas'))) {
            mkdir(storage_path('app/public/notas'));
        }
        $reservation->nota = true;
        $reservation->save();

        return PDF::loadView('pdf.nota', $data)->save(storage_path('app/public/notas/'.$reservation->number.'.pdf'))->stream($reservation->number.'.pdf');
    }
}
