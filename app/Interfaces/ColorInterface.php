<?php

namespace App\Interfaces;

use Illuminate\Http\Request;
use phpseclib3\Math\PrimeField\Integer;

interface ColorInterface
{

    public function colors();

    public function ColorToggleStatus(int $id);

    public function ColorSearch(string $query);

    public function StoreColor(array $data);

    public function EditColor(int $id);

    public function UpdateColor(int $id, array $data);

    public function DeleteColor($id);

}
