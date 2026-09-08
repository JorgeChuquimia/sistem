<?php

namespace App\Actions;

use App\Models\Persona;
use Illuminate\Support\Facades\DB;

class UpdatePersonaAction
{
    public function execute(Persona $persona, array $data): Persona
    {
        return DB::transaction(function () use ($persona, $data) {
            // usuario_id se excluye para proteger la integridad de la relación 1:1
            $persona->update($data);
            return $persona;
        });
    }
}
