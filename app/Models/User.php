<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = ['name', 'email', 'password', 'total_balance'];
    protected $visible = ['id', 'name', 'email', 'total_balance'];


    public function incomes()
    {
        return $this->hasMany(Income::class);
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }

    // Mutador para actualizar el saldo total
    public function setTotalBalanceAttribute($value)
    {
        // No sobrescribas el valor, agrega el nuevo valor al saldo existente
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
