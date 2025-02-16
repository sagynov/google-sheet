<?php

namespace App\Livewire;

use Livewire\Component;
use Revolution\Google\Sheets\Facades\Sheets;
use Illuminate\Validation\Rule;
use App\Enums\SheetStatus;
use App\Models\Sheet;

class SheetLive extends Component
{
    // Global
    public $sheets;
    // Google sheet
    public $spreadsheet_id;
    public $spreadsheet_url;
    public $sheet_id;
    // Form
    public $first_name;
    public $last_name;
    public $status = 'allowed';
    // Edit
    public $current_id;

    protected function rules()
    {
        return [
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'status' => [
                'required',
                Rule::enum(SheetStatus::class)
            ],
        ];
    }

    public function mount()
    {
        if (!session()->exists('post_spreadsheet_id')) {
            session()->put('post_spreadsheet_id', config('google.post_spreadsheet_id'));
        }
        if (!session()->exists('post_sheet_id')) {
            session()->put('post_sheet_id', config('google.post_sheet_id'));
        }
        $this->spreadsheet_id = session('post_spreadsheet_id');
        $this->sheet_id = session('post_sheet_id');
        $this->sheets = Sheets::spreadsheet(session('post_spreadsheet_id'))->sheet(session('post_sheet_id'))->get()->toArray();
    }
    public function sync()
    {
        Sheet::truncate();
        $data = [];
        foreach(array_slice($this->sheets, 1) as $row){
            $data[] = [
                'first_name' => $row[0],
                'last_name' => $row[1],
                'status' => $row[2],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        Sheet::insert($data);
        session()->flash('sync', 'Выгрузка прошла успешно');
    }
    public function clearTable()
    {
        Sheets::spreadsheet(session('post_spreadsheet_id'))->sheet(session('post_sheet_id'))->clear();
        Sheets::spreadsheet(session('post_spreadsheet_id'))->sheet(session('post_sheet_id'))->append([$this->sheets[0]]);
        $this->sheets = array_slice($this->sheets, 0, 1);
        session()->flash('clear', 'Таблица успешно очищена');
    }
    public function saveDocument()
    {
        session()->put('post_spreadsheet_id', $this->spreadsheet_id);
        session()->put('post_sheet_id', $this->sheet_id);
        try {
            $this->sheets = Sheets::spreadsheet(session('post_spreadsheet_id'))->sheet(session('post_sheet_id'))->get()->toArray();
        } catch (\Throwable $th) {
            session()->flash('message', 'Ошибка: Нет доступа к документу');
            session()->put('post_spreadsheet_id', config('google.post_spreadsheet_id'));
            session()->put('post_sheet_id', config('google.post_sheet_id'));
            $this->spreadsheet_id = session('post_spreadsheet_id');
            $this->sheet_id = session('post_sheet_id');
            $this->sheets = Sheets::spreadsheet(session('post_spreadsheet_id'))->sheet(session('post_sheet_id'))->get()->toArray();
        }
    }
    public function editUser($id)
    {
        $this->current_id = $id;
        foreach ($this->sheets as $key => $row) {
            if($key == $id){
                $this->first_name = $row[0];
                $this->last_name = $row[1];
                $this->status = $row[2];
            }
        }
    }
    public function deleteUser($id)
    {
        unset($this->sheets[$id]);
        Sheets::spreadsheet(session('post_spreadsheet_id'))->sheet(session('post_sheet_id'))->clear();
        Sheets::spreadsheet(session('post_spreadsheet_id'))->sheet(session('post_sheet_id'))->append(array_values($this->sheets));
    }
    public function saveUser()
    {
        $this->validate();
        if($this->current_id) {
            $this->sheets[$this->current_id][0] = $this->first_name;
            $this->sheets[$this->current_id][1] = $this->last_name;
            $this->sheets[$this->current_id][2] = $this->status;
            Sheets::spreadsheet(session('post_spreadsheet_id'))->sheet(session('post_sheet_id'))->update($this->sheets);
            $this->reset(['first_name', 'last_name', 'current_id']);
        }else{
            Sheets::spreadsheet(session('post_spreadsheet_id'))->sheet(session('post_sheet_id'))->append([
                [$this->first_name, $this->last_name, $this->status, now()->format('d.m.Y')]
            ]);
            $this->reset(['first_name', 'last_name']);
            $this->sheets = Sheets::spreadsheet(session('post_spreadsheet_id'))->sheet(session('post_sheet_id'))->get()->toArray();
        }
    }

    public function render()
    {
        return view('livewire.sheet-live');
    }
}
