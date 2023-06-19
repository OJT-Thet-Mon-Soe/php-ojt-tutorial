<?php
use Faker\Factory;
require("vendor/autoload.php");

function seeding(){
    for ($i=0; $i < 60; $i++) { 
        $faker = Factory::create();
        $fakerTitle = $faker->name();
        $fakerContent = $faker->text();
        $fakerIsPublish = $faker->numberBetween(0, 1); 
        $date = $faker->dateTimeBetween('-40 days', '0 days');
        $dateData = $date->format('Y-m-d h:m:i');
        $fakeInsertData = new ReadInsertDeleteUpdate();
        $fakeInsertData->insertDummyData($fakerTitle,$fakerContent,$fakerIsPublish,$dateData);
    }
}