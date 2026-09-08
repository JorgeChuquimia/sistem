<?php

namespace App\Actions;

use App\Models\Persona;
use Illuminate\Support\Facades\DB;

class CreatePersonaAction
{
    public function execute(array $data): Persona
    {
        return DB::transaction(function () use ($data) {
            $data['estado'] = true;
            return Persona::create($data);
        });
    }
}
