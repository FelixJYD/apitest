<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = ['name', 'email', 'password', 'total_balance'];
    use HasFactory;

    // Inicializa el atributo total_balance
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->total_balance = 0; // Inicializa el total_balance en 0 al crear un nuevo usuario
        });
    }

    // Mutador para actualizar el saldo total
    public function setTotalBalanceAttribute($value)
    {
        if (!isset($this->attributes['total_balance'])) {
            $this->attributes['total_balance'] = 0;
        }

        $this->attributes['total_balance'] += $value;
    }

    // Accesor para obtener el saldo total actualizado en tiempo real
    public function getTotalBalanceAttribute()
    {
        // Calcula el saldo total en base a los ingresos y gastos del usuario
        $incomeTotal = $this->incomes()->sum('amount');
        $expenseTotal = $this->expenses()->sum('amount');
        return $incomeTotal - $expenseTotal;
    }
}
