<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('departments')->insert([
            [
                'course' => 'BSIT',
                'department' => 'CCS'
            ],
            [
                'course' => 'BSCS',
                'department' => 'CCS'
            ],
            [
                'course' => 'BSEMC',
                'department' => 'CCS'
            ],
            [
                'course' => 'ACT',
                'department' => 'CCS'
            ],
            [
                'course' => 'BSA',
                'department' => 'CBA'
            ],
            [
                'course' => 'BSBA',
                'department' => 'CBA'
            ],
            [
                'course' => 'BSN',
                'department' => 'CAHS'
            ],
            [
                'course' => 'BSM',
                'department' => 'CAHS'
            ],
            [
                'course' => 'BSED',
                'department' => 'CEAS'
            ],
            [
                'course' => 'BSHRM',
                'department' => 'CHTM'
            ],
            [
                'course' => 'BST',
                'department' => 'CHTM'
            ],
        ]);
    }
}
