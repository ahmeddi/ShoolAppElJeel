<?php

namespace App\Traits;

use App\Enums\Dates;
use Livewire\Attributes\Url;
use Illuminate\Support\Facades\DB;



trait Rangables
{
    private $table_col_id;
    private $table_col_date;

    public $ranges;

    public $customRangeStart;
    public $customRangeEnd;

    //#[Url]
    public $selectedRange = 'all';

    public $rangeName;

    #[Url]
    public $sortCol;

    #[Url]
    public $sortAsc = true;

    public function sortBy($col)
    {
        if ($this->sortCol == $col) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortCol = $col;
            $this->sortAsc = true;
        }
    }

    protected function applySorting($query, $montant = null)
    {
        if ($this->sortCol) {
            if ($this->sortCol == 'montant') {
                // dd('hi');
                $query->orderBy(DB::raw('CAST(montant AS DECIMAL(10, 2))'), $this->sortAsc ? 'asc' : 'desc');
            } else {
                $query->orderBy($this->sortCol, $this->sortAsc ? 'asc' : 'desc');
            }
        }

        return $query;
    }


    public function updatedSelectedRange($query)
    {

        $this->ranges = collect($this->ranges);

        $specificRange = $this->ranges->where('value', $this->selectedRange)->first();

        if ($this->selectedRange == 'all') {
            return $query;
        }
        if ($this->selectedRange == 'custom') {
            return $this->applyRanges($query, $this->customRangeStart, $this->customRangeEnd);
        }

        return  $this->applyRanges($query, $specificRange->dates()[0], $specificRange->dates()[1]);
    }




    function filter($range)
    {
        if ($range == 'custom') {
            $this->selectedRange = 'custom';
            $this->rangeName = Dates::Custom->label();
            return;
        } else if ($range == 'All_Time') {
            $this->selectedRange = 'all';
            $this->rangeName = Dates::All_Time->label();
            return;
        }

        $ranges = Dates::cases();

        $ranges = collect(Dates::cases());

        $specificRange = $ranges->first(function ($case) use ($range) {
            return $case->name === $range;
        });
        $this->selectedRange = $specificRange->value;
        $this->rangeName = $specificRange->label();
    }


    public function applyRanges($query, $date1, $date2)
    {
        // dd($query);

        $dates = [$date1, $date2];

        if ($this->table_col_id == 'all') {
            $query = $query->whereBetween($this->table_col_date, $dates);
        } else {
            $query = $query->where($this->table_col_id, $this->ids)
                ->whereBetween($this->table_col_date, $dates);
        }


        return $query;
    }
}
