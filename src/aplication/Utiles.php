<?php

namespace aplication;

class Utiles
{

    public static function Encryp(string $string): string
    {
        $arrayString = preg_split('/(,)/i', $string);
        $stringRes = '';
        $tableCryp = [
            '#' =>  'a',
            '$' =>  'b',
            '@' =>  'c',
            '*' =>  'd',
            '!' =>  'e',
            '+' =>  'f',
            '-' =>  'g',
            '33' =>  'h',
            '554' =>  'i',
            '.' =>  'j',
            'R' =>  'k', //%,554,:
            '11' =>  'l',
            '%' =>  'm',
            'ñ' =>  'ñ',
            '21' =>  'n',
            '^' =>  'o',
            '45' =>  'p', 
            '<' =>  'q',
            ';' =>  'r',
            ':' =>  's',
            '>' =>  't',
            'Y' =>  'u',
            'j' =>  'w',
            '9' =>  'x',
            'F' =>  'y',
            '?' =>  'z',
            'z'=>   '0',  
            'q'=>   '1',  
            'a'=>   '2',  
            't'=>   '3',  
            'j'=>   '4',  
            'e'=>   '5',  
            'E'=>   '6',  
            'O'=>   '7',  
            '0'=>   '8',  
            'x'=>   '9'
          ];

        foreach($arrayString as $value){
            $stringRes .= $tableCryp[$value]; 
        }

        return $stringRes;
    }

    public static function codigoActa(string $lastCode){
        date_default_timezone_set('America/Guayaquil');
        $codSeparete = preg_split('/(-)/i',$lastCode);
        $codeNumber = intval($codSeparete[1],10);
        $date = new \DateTime();
        $year = $date->format('Y');
        //Aumenta el valor del ultimo codigo que tiene la base de datos si es un solo digito
        // se aumentan dos ceros por defecto si dos digitos un cero y si son tres solo se le suma
        //una unidad
        $newNumber = $codeNumber+1;
        $newCode = '';
        if($newNumber > 99){
            $newCode = $year . '-' . $newNumber;
        }else if($newNumber > 9){
            $newCode = $year . '-' . '0' . $newNumber;
        }else{
            $newCode = $year . '-' . '00' . $newNumber;
        }

        return $newCode;

    }
    
}

