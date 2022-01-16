<?php

include_once 'GPvisit.php';
include_once 'LifeExpectancy.php';

class DataAccess{
    public function getVisits(){
        $visits = [];
        $rowHeaders = [];

        $file = fopen('../data/GPvisits.csv','r');
        if($file){
            $lineCount = 0;

            while($row = fgetcsv($file,1000,'r'))
            {
                if($lineCount > 0){
                    $visit = new GPvisit($row[0],$row[1],$row[2],$row[3]);
                    $visits[] = $visit;
                    $lineCount++;
                }
                else{
                    $rowHeaders = $row;
                    $lineCount++;
                }
            }
        }
        return $visits;
    }

    public function getLE($filename){
        $LEs = [];
        $rowHeaders = [];

        $file = fopen($filename,'r');
        if($file){
            $lineCount = 0;

            while($row = fgetcsv($file,1000,'r'))
            {
                if($lineCount > 0){
                    $LE = new LifeExpectancy($row[0],$row[1],$row[2],$row[3],$row[4]);
                    $LEs[] = $LE;
                    $lineCount++;
                }
                else{
                    $rowHeaders = $row;
                    $lineCount++;
                }
            }
        }
        return $LEs;
    }
}
