<?php

namespace App\Http\Controllers;

class QuickSortController extends Controller
{
    public function index()
    {
        $array = $this->initArray();

        dump('init');
        $this->printArray($array);

        $this->sort($array, 0, count($array) - 1);

        dump('sorted');
        $this->printArray($array);
    }

    private function sort(&$letters, $start, $end)
    {
        if($start < $end) {
            $pivot = $this->partition($letters, $start, $end);
            $this->sort($letters, $start, $pivot - 1);
            $this->sort($letters, $pivot + 1, $end);
        }
    }

    private function partition(&$letters, $start, $end)
    {
        $pivot = $start;

        for($i = $start; $i < $end; $i++) {
            $currentKey = key($letters[$i]);
            $endKey = key($letters[$end]);

            if($currentKey <= $endKey) {
                $buf = $letters[$i];
                $letters[$i] = $letters[$pivot];
                $letters[$pivot] = $buf;
                $pivot++;
            }
        }

        $buf = $letters[$pivot];
        $letters[$pivot] = $letters[$end];
        $letters[$end] = $buf;

        return $pivot;
    }

    private function initArray()
    {
        $letter = 'a';

        $letters = [
            [$letter => 1]
        ];

        $index = 1;
        while ($letter < 'z') {
            $letters[] = [++$letter => ++$index];
        }

        shuffle($letters);

        return $letters;
    }

    private function printArray($array)
    {
        foreach ($array as $item) {
            echo key($item) . ' ' . $item[key($item)] . '<br>';
        }
    }
}