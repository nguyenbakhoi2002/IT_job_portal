<?php

namespace App\Exports;
use App\Models\JobPostActivity;
use App\Models\JobPost;


use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class ListProfileExport implements FromCollection, WithHeadings,WithMapping,WithColumnWidths
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function collection()
    {
        $jobPost = JobPost::find($this->id);
        // $list_seekerProfile = $jobPost->seekerProfile()->paginate(10);
        $list_seekerProfile = $jobPost->applied;
        return $list_seekerProfile;
    }
    //các cột muốn lấy
    public function map($row): array
    {
        return [
            $row->name,
            $row->email,
            $row->phone,
            $row->address,
            $row->satisfy,
            $row->satisfy_count,
        ];
    }
    //độ rộng các cột
    public function columnWidths(): array
    {
        return [
            'A'=>25,
            'B'=>30,
            'C'=>20,
            'D'=>50,
            'E'=>40,
            'F'=>20,
            // 'name'=>30,
            // 'email'=>30,
            // 'phone'=>20,
            // 'address'=>50,
            // 'satisfy'=>40,
            // 'satisfy_count'=>10,
        ];
    }
    //heading
    public function headings(): array
    {
        return [
            'Name',
            'Email',
            'Phone',
            'Address',
            'Các tiêu chí thỏa mãn',
            'Số tiêu chí thỏa mãn',
        ];
    }
}
