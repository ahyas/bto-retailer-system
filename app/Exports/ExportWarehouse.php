<?php
 
namespace App\Exports;
 
use App\Warehouse;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use DB;
 
class ExportWarehouse implements FromCollection, WithHeadings, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $table = DB::table("tb_item")
        ->select("tb_item.code as barcode","tb_item.name as item","tb_category.name as category_name","tb_sub_category.name as sub_category_name",DB::raw("FORMAT(tb_item.stock, 0)"),"tb_ref_unit.name AS unit")
        ->leftjoin("tb_category", "tb_item.code_category","=","tb_category.code")
        ->leftJoin("tb_sub_category", "tb_item.code_sub_category","=","tb_sub_category.code")
        ->leftjoin("tb_ref_unit","tb_item.code_unit","=","tb_ref_unit.id")
        ->orderBy("tb_item.created_at","DESC")
        ->get();

        return $table;
    }

    public function headings(): array
    {
        return ["Barcode","Item","Category","Sub category","Stock","Unit"];
    }

    public function registerEvents(): array{
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->getDelegate()->getRowDimension('1')->setRowHeight(20);
                $event->sheet->getDelegate()->getColumnDimension('A')->setWidth(20);
                $event->sheet->getDelegate()->getColumnDimension('B')->setWidth(100);
                $event->sheet->getDelegate()->getColumnDimension('C')->setWidth(35);
                $event->sheet->getDelegate()->getColumnDimension('D')->setWidth(30);
                $event->sheet->getDelegate()->getColumnDimension('E')->setWidth(10);
                $event->sheet->getDelegate()->getColumnDimension('F')->setWidth(10);
     
            },
        ];
    }

    
}

?>