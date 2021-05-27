<?php

namespace App\FactoryProcessor;

use Faker\Factory;
Use Carbon\Carbon;

class FactoryProcessor
{
    private array $types = [
        'faker',
        'number',
        'password',
        'date',
        'rand'
    ];

    private array $table_data_array = [];

    protected $faker;

    public function __construct()
    {
        $this->faker = Factory::create();
    }

    private function executeFaker($actions) : string
    {
        $result = '';

        // Methode
        $method = $actions[1];

        if(array_key_exists(2, $actions)) {
            // Extra parameter, dus een functie in faker
            $result = $this->faker->$method($actions[2]);
        } else {
            $result = $this->faker->$method;
        }

        return $result;
    }

    public function process($columns) : array
    {
        $this->table_data_array = [];

        foreach($columns as $column_name => $action) {
            
            $split_action = explode(':', $action);
           
            switch(strtolower($split_action[0])) {
                case 'faker':
                    // indices 1 en/of 2
                    $this->table_data_array[$column_name] = $this->executeFaker($split_action);
                    break;

                case 'number':
                    // number:1
                    $this->table_data_array[$column_name] = $split_action[1];
                    break;

                case 'password':
                    // password:welkom
                    $this->table_data_array[$column_name] = password_hash($split_action[1], PASSWORD_DEFAULT);
                    break;

                case 'date':
                    // date:timestamp
                    $this->table_data_array[$column_name] = Carbon::now('Europe/Amsterdam')->toDateTimeString();
                    break;

                case 'rand':
                    // rand:1:10
                    $this->table_data_array[$column_name] = strval(rand(intval($split_action[1]), intval($split_action[2])));
                    break;
            }
        }

        return $this->table_data_array;
    }

}