<?php

namespace Database\Seeders;

use App\Models\Relation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RelationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json  = file_get_contents(database_path() . '/data/relation.json');
        $data  = json_decode($json);
        foreach ($data->relations as $key => $value) {
            $relations = new Relation();
            $relations->name = $value->name;
            $relations->save();
        }
    }
}
