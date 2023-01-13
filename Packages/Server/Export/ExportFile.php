<?php

namespace Packages\Server\Export;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Packages\Server\Services\Export\ExportService;

class ExportFile implements FromCollection, WithHeadings,WithMapping, WithColumnWidths
{
    use Exportable;

    public function __construct($month, $year)
    {
        $this->month = $month;
        $this->year = $year;
    }

    public function collection()
    {
        return (((new \Packages\Server\Services\Export\ExportService)->getDoanhThu($this->month, $this->year)));
    }

    public function headings(): array
    {
        // TODO: Implement headings() method.
        return [
            'Tên sản phẩm',
            'Tổng doanh thu',
            'Giá tiền',
            "Số lượng",

        ];
    }

    public function map($row): array
    {
        // TODO: Implement map() method.
        return [
            $row->name,
            $row->nsum,
            $row->price,
            $row->count
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 60,
            'B' => 30,
        ];
    }
}
