<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\InvokableRule;
use Illuminate\Support\Facades\DB;

class UniqueSoft implements InvokableRule
{
    public $table;
    public $idColumn;
    public $idToIgnore;

    public function __construct($tableName, $idColumn, $idToIgnore)
    {
        $this->table = $tableName;
        $this->idColumn = $idColumn;
        $this->idToIgnore = $idToIgnore;
    }
    
    
    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     * @return void
     */
    public function __invoke($attribute, $value, $fail)
    {
        $query = DB::table($this->table)
                    ->where($attribute, $value)
                    ->where($this->idColumn, '!=', $this->idToIgnore)
                    ->first();

        if ($query && $query->deleted_at) {
            $fail('The :attribute already belongs to a deleted record.');
        } elseif ($query) {
            $fail('The :attribute has already been taken.');
        }
    }
}
