<?php

namespace App\Imports;

use App\Models\Task;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class TaskImport implements ToModel, WithHeadingRow, WithValidation
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
    
    public function model(array $row)
    {
        return new Task([
            'task' => $row['task'],
            'user_id' => $this->user->id,
            'deadline' => $row['deadline'],
        ]);
    }

    public function rules(): array
    {
        return [
            'task' => 'required',
            'deadline' => 'required'
        ];
    }
}
