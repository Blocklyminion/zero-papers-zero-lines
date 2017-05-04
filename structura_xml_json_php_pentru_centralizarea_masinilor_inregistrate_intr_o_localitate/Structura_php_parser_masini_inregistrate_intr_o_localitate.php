<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Structura_php_parser_masini_inregistrate_intr_o_localitate extends CI_Controller {

    public function import()
    {
        $filename = $_FILES['xmlFile']['name'];//Xml or Json File
        copy($_FILES['xmlFile']['tmp_name'], './assets/'.$filename);
       $xmlFile = "./assets/".$filename;

        $ext = pathinfo($xmlFile, PATHINFO_EXTENSION);
        $allowed = array('json');
        //XML Parser
        if (!in_array( $ext, $allowed )) {

            $xmlDoc = new DOMDocument();
            $xmlDoc->load($File);

            $xmlObject = $xmlDoc->getElementsByTagName('car');

           //If you want to know the length.
            $itemCount = $xmlObject->length;


            foreach ($xmlObject as $searchNode) {

                $nameplate = $searchNode->getElementsByTagName("nameplate");
                $nameplate = $nameplate->item(0)->nodeValue;

                $category = $searchNode->getElementsByTagName("category");
                $category = $category->item(0)->nodeValue;

                $manufacter = $searchNode->getElementsByTagName("manufacter");
                $manufacter = $manufacter->item(0)->nodeValue;

                $model = $searchNode->getElementsByTagName("model");
                $model = $model->item(0)->nodeValue;

                $ci_number = $searchNode->getElementsByTagName("ci_number");
                $ci_number = $ci_number->item(0)->nodeValue;

                $vin = $searchNode->getElementsByTagName("vin");
                $vin = $vin->item(0)->nodeValue;

                $registration_series = $searchNode->getElementsByTagName("registration_series");
                $registration_series = $registration_series->item(0)->nodeValue;

                $owner = $searchNode->getElementsByTagName("owner");
                $owner = $owner->item(0)->nodeValue;

                $owner_address = $searchNode->getElementsByTagName("owner_address");
                $owner_address = $owner_address->item(0)->nodeValue;

                $lat = $searchNode->getElementsByTagName("lat");
                $lat = $lat->item(0)->nodeValue;

                $long = $searchNode->getElementsByTagName("long");
                $long = $long->item(0)->nodeValue;

                $manufacter_date = $searchNode->getElementsByTagName("manufacter_date");
                $manufacter_date = $manufacter_date->item(0)->nodeValue;

                $registration_date = $searchNode->getElementsByTagName("registration_date");
                $registration_date = $registration_date->item(0)->nodeValue;

                $cylindrel_capacity = $searchNode->getElementsByTagName("cylindrel_capacity");
                $cylindrel_capacity = $cylindrel_capacity->item(0)->nodeValue;

                $nominal_weight = $searchNode->getElementsByTagName("nominal_weight");
                $nominal_weight = $nominal_weight->item(0)->nodeValue;

                $maximum_weight = $searchNode->getElementsByTagName("maximum_weight");
                $maximum_weight = $maximum_weight->item(0)->nodeValue;

                $nominal_power = $searchNode->getElementsByTagName("nominal_power");
                $nominal_power = $nominal_power->item(0)->nodeValue;

                $fuel_type = $searchNode->getElementsByTagName("fuel_type");
                $fuel_type = $fuel_type->item(0)->nodeValue;

                $color = $searchNode->getElementsByTagName("color");
                $color = $color->item(0)->nodeValue;

                $number_of_seats = $searchNode->getElementsByTagName("number_of_seats");
                $number_of_seats = $number_of_seats->item(0)->nodeValue;

                $date_of_next_inspection = $searchNode->getElementsByTagName("date_of_next_inspection");
                $date_of_next_inspection = $date_of_next_inspection->item(0)->nodeValue;



                $this->model_insert->insert([
                    'nameplate' => $nameplate,
                    'category' => $category,
                    'manufacter' => $manufacter,
                    'model' => $model,
                    'ci_number' => $ci_number,
                    'vin' => $vin,
                    'registration_series' => $registration_series,
                    'owner' => $owner,
                    'owner_address' => $owner_address,
                    'lat' => $lat,
                    'long' => $long,
                    'manufacter_date' => $manufacter_date,
                    'registration_date' => $registration_date,
                    'cylindrel_capacity' => $cylindrel_capacity,
                    'nominal_weight' => $nominal_weight,
                    'maximum_weight' => $maximum_weight,
                    'nominal_power' => $nominal_power,
                    'fuel_type' => $fuel_type,
                    'color' => $color,
                    'number_of_seats' => $number_of_seats,
                    'date_of_next_inspection' => $date_of_next_inspection
                ]);

            }
        }
     //JSON Parser
        else{
         $jsondata = file_get_contents($File);
         $json=json_decode($jsondata,true);

         foreach ($json['cars'] as $row){
             $nameplate = $row['nameplate'];
             $category = $row['category'];
             $manufacter = $row['manufacter'];
             $model = $row['model'];
             $ci_number = $row['ci_number'];
             $vin = $row['vin'];
             $registration_series = $row['registration_series'];
             $owner = $row['owner'];
             $owner_address = $row['owner_address'];
             $lat = $row['lat'];
             $long = $row['long'];
             $manufacter_date = $row['manufacter_date'];
             $registration_date = $row['registration_date'];
             $cylindrel_capacity = $row['cylindrel_capacity'];
             $nominal_weight = $row['nominal_weight'];
             $maximum_weight = $row['maximum_weight'];
             $nominal_power = $row['nominal_power'];
             $fuel_type = $row['fuel_type'];
             $color = $row['color'];
             $number_of_seats = $row['number_of_seats'];
             $date_of_next_inspection = $row['date_of_next_inspection'];
             $this->model_insert->insert([
                 'nameplate' => $nameplate,
                 'category' => $category,
                 'manufacter' => $manufacter,
                 'model' => $model,
                 'ci_number' => $ci_number,
                 'vin' => $vin,
                 'registration_series' => $registration_series,
                 'owner' => $owner,
                 'owner_address' => $owner_address,
                 'lat' => $lat,
                 'long' => $long,
                 'manufacter_date' => $manufacter_date,
                 'registration_date' => $registration_date,
                 'cylindrel_capacity' => $cylindrel_capacity,
                 'nominal_weight' => $nominal_weight,
                 'maximum_weight' => $maximum_weight,
                 'nominal_power' => $nominal_power,
                 'fuel_type' => $fuel_type,
                 'color' => $color,
                 'number_of_seats' => $number_of_seats,
                 'date_of_next_inspection' => $date_of_next_inspection
             ]);

         }
        }

    }
}
