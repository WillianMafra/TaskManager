<?php

namespace App\Exports;

use App\Models\Task;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class tasksExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Task::where('user_id', auth()->user()->id)->get();
    }

    // Setting the headings on the file
    public function headings(): array {
        return [
            'Task ID',
            'Task Name',
            'Deadline'
        ];
    }

    // Setting the traits por each line on the file
    public function map($line): array {
        return [
            $line->id,
            $line->task_name,
            date('d/m/Y h:i A', strtotime($line->date))
        ];
    }
}
