<?php


namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;


trait ApiTrait{
    /**
     * Filtra la consulta basada en los filtros permitidos y los valores proporcionados en la solicitud.
     *
     * Este método aplica filtros a la consulta basándose en los parámetros de filtro proporcionados en la solicitud.
     * Los filtros permitidos se definen en las propiedades $allowFilter y $allowFilterStrict del modelo.
     * 
     * - Si $allowFilterStrict contiene el filtro, se aplica una condición de igualdad exacta.
     * - Si $allowFilter contiene el filtro, se aplica una condición de búsqueda con comodines (LIKE).
     * 
     * Ejemplo de uso:
     * ```
     *  $tasks = Task::filter()->getOrPaginate();
     *  // GET /api/tasks?filter[title]=Task 1&filter[status]=PENDIENTE
     * ```
     */
    public function scopeFilter(Builder $query)
    {
        if(empty($this->allowFilter) || empty(request('filter'))) {
            return $query;
        }

        $filters = request('filter');
        $allowFilter = collect($this->allowFilter);
        $allowFilterStrict = collect($this->allowFilterStrict);
        foreach ($filters as $filter => $value) {

            $filterOriginal = $this->unformatMap[$filter] ?? $filter;

            if($allowFilterStrict->contains($filterOriginal)) {
                $query->where($filterOriginal, $value);
            }
            else if($allowFilter->contains($filterOriginal)) {
                $query->where($filterOriginal,'LIKE', "%$value%");
            }
        }

        return $query;
    }

    public function scopeSort(Builder $query)
    {
        if(empty($this->allowSort) || empty(request('sort'))) {
            return $query;
        }

        $sortFields = explode(',', request('sort'));
        $allowSort = collect($this->allowSort);
        foreach ($sortFields as $sortField) {

            $direction = 'asc';
            
            if(substr($sortField, 0, 1) == '-') {
                $direction = 'desc';
                $sortField = substr($sortField, 1);
            }

            $sortField = $this->unformatMap[$sortField] ?? $sortField;

            if($allowSort->contains($sortField)) {
                $query->orderBy($sortField, $direction);

            }

        }
    }

    public function scopeGetOrPaginate(Builder $query)
    {
        if(request('perPage')) {
            $perPage = intval(request('perPage'));
            if($perPage){
                return $query->paginate($perPage);
            }
        }
        return $query->get();
    }
}