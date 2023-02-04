<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    public function productos()
    {
        return $this->belongsToMany(Producto::class)
                    ->withPivot("cantidad")
                    ->withTimestamps();
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public static function generateInvoiceNumber()
    {
        // Obtén el último número de factura
        $lastInvoice = self::orderBy('id', 'desc')->first();
        $lastInvoiceNumber = $lastInvoice ? $lastInvoice->id : 0;

        // Genera un nuevo número de factura
        $newInvoiceNumber = $lastInvoiceNumber + 1;
        $newInvoiceNumber = sprintf('%03d', $newInvoiceNumber);

        // Agrega el prefijo y devuelve el nuevo número de factura
        $newInvoiceNumber = 'FAC-' . $newInvoiceNumber;

        

        return $newInvoiceNumber;
    }
}
