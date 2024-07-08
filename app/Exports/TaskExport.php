<?php

namespace App\Exports;

use App\Models\Task;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TaskExport implements FromCollection, WithHeadings, WithMapping
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function collection()
    {
        return $this->user->tasks()->select('task', 'deadline')->get();
    }

    public function headings(): array
    {
        return ["Task", "Deadline"];
    }

    public function map($row): array
    {
        $row->deadline = date('d/m/Y', strtotime($row->deadline));
        return [
            $row->task,
            $row->deadline
        ];
    }
}

