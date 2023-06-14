<?php

namespace App\Http\Controllers;

use App\Models\Utente;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UtenteController extends Controller
{
    public function show(Utente $utente): View
    {
        if (Auth::user()->id != $utente->user_id) {
            abort(403);
        }

        return view('utentes.show', [
            'utente' => $utente
        ]);
    }

    public function edit(Utente $utente): View
    {
        if (Auth::user()->id != $utente->user_id) {
            abort(403);
        }

        return view('utentes.edit', [
            'utente' => $utente
        ]);
    }
}
