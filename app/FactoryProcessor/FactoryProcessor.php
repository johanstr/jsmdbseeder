<?php

namespace App\FactoryProcessor;

use Faker\Factory;
Use Carbon\Carbon;

class FactoryProcessor
{
    private array $types = [
        'faker:method',
        'number:number',
        'password:text',
        'date:timestamp',
        'rand:min:max',
        'faker:randomChars:length:modifier',      // Modifier: uppercase, lowercase
        'faker:gender:length:modifier',
    ];

    private array $table_data_array = [];

    protected $faker;

    public function __construct()
    {
        $this->faker = Factory::create();
    }

    private function randomChars($actions) : string
    {
        $randomString = '';

        if(array_key_exists(2, $actions) && array_key_exists(3, $actions))
        {
            $length = intval($actions[2]);
            $modifier = 'strtolower';
            if($actions[3] === 'uppercase') $modifier = 'strtoupper';

            $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }

            $randomString = $modifier($randomString);
        }

        return $randomString;
    }

    private function gender($actions) : string 
    {
        $gender = 'M';
        $full_gender = [ 'Male', 'Female' ];
        $short_gender = [ 'M', 'F' ];

        if(array_key_exists(2, $actions) && array_key_exists(3, $actions))
        {
            $modifier = ($actions[3] === 'lowercase' ? 'strtolower' : 'strtoupper');
            $length = intval($actions[2]);

            if($length === 1) 
                $gender = $modifier($short_gender[ rand(0,1) ]);
            else
                $gender = $full_gender[ rand(0,1) ];
        }

        return $gender;
    }

    private function executeFaker($actions) : string
    {
        $result = '';

        // Methode
        $method = $actions[1];

        if($method === 'randomChars') {
            // Eigen faker like functie
            // randomChars(length, modifier)
            $result = $this->randomChars($actions);
        } elseif($method === 'gender') {
            $result = $this->gender($actions);
        } else {
            // Default faker
            if(array_key_exists(2, $actions)) {
                // Extra parameter, dus een functie in faker, dan is actions[2] of een getal of een array
                if(strpos($actions[2], ',') > 0)
                    $arguments = explode(',', $actions[2]);
                else
                    $arguments = $actions[2];
                $result = $this->faker->$method($arguments);
            } else {
                $result = $this->faker->$method;
            }
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

                case 'text':
                    // text:modifier:method/text
                    break;
            }
        }

        return $this->table_data_array;
    }

}