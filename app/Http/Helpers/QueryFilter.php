<?php

namespace App\Http\Helpers;

use App\Models\Country;
use Illuminate\Support\Facades\Validator;

class QueryFilter
{
    /**
     * General filter to a query. Applies AND as operator.
     *
     * @param \Illuminate\Http\Request  $request
     * @param \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function Filter($request, $query)
    {
        // Aplicar filtros si se reciben en la solicitud
        if ($request->has('filters')) {
            $filters = explode('|', $request->input('filters'));

            foreach ($filters as $filter) {
                // Separar el filtro en sus componentes
                $components = explode(',', $filter);
                if (count($components) < 2 || count($components) > 3) {
                    continue;
                }

                $field = $components[0];
                $operator = count($components) == 3 ? $components[1] : '=';
                $value = count($components) == 3 ? $components[2] : $components[1];

                // Validar el filtro
                if($field == 'country_key') {
                    $field = 'country_id';
                    $estado = Country::where('country_key',$value)->first();
                    $value = $estado->country_id;
                }



                $validatedData = Validator::make([
                    'field' => $field,
                    'value' => $value,
                    'operator' => $operator
                ], [
                    'field' => 'required|string',
                    'value' => 'required',
                    'operator' => 'nullable|in:=,!=,>,<,>=,<=,like'
                ])->validate();

                // Aplicar el filtro a la consulta
                if($operator === 'like') {
                    $query->where($field, 'LIKE', "%$value%");
                } else {
                    $query->where($field, $operator, $value);
                }
            }
        }

        return $query;
    }

    /**
     * Search filter with OR clauses
     *
     * @param \Illuminate\Http\Request  $request
     * @param \Illuminate\Database\Eloquent\Builder  $query
     * @param string[]  $searchAttributes
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function Search($request, $query, $searchAttributes)
    {
       // Validate that $searchAttributes are not null

        // Aplicar filtros si se reciben en la solicitud
        if ($request->has('search')) {
            $searchKeyword = $request->input('search');

            $query->where(function($searchQuery) use($searchAttributes, $searchKeyword) {
                for ($i = 0; $i < count($searchAttributes); $i++) {
                    $searchQuery->where($searchAttributes[$i], 'LIKE', "%$searchKeyword%", $i == 0 ? 'and' : 'or');
                };
                return $searchQuery;
            });
        }

        return $query;
    }
}
