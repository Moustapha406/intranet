<?php

namespace App\Exports;


use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Illuminate\Support\Collection;

class ProductionExport implements FromCollection, WithMapping, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */

    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {


        return collect($this->data);
    }

    public function headings(): array
    {
        return [
            'Date',
            'Atelier',
            'Quantité de la production',
            'TRG du jour',
            'Cadence journaliere',
            'Nombre de quart par default',
            'Observation'
        ];
    }

    // public function prepareRows($rows)
    // {
    //     // dd($rows);

    //     return $rows->transform(function ($data) {
    //         $data->trg .= ' (prepared)';

    //         return $data;
    //     });
    // }

    public function map($rows): array
    {
        $transData = array_map(function ($r) {
            $r['TRG'] .= " %";

            return $r;
        }, $rows);

        return $transData;
    }
}