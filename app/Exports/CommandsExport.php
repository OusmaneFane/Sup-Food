<?php
namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class CommandsExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    protected $commands;

    public function __construct($commands)
    {
        $this->commands = $commands;
    }

    public function collection()
    {
        return $this->commands;
    }

    public function map($command): array
    {
        return [
            $command->created_at->format('d/m/Y H:i'),
            $command->user->name,
            $command->delivery_address,
            $command->total_items,
            $command->total_price . ' F CFA',
            ucfirst($command->status),
        ];
    }

    public function headings(): array
    {
        return [
            'Date',
            'Client',
            'Adresse',
            'Articles',
            'Total',
            'Statut',
        ];
    }
}
