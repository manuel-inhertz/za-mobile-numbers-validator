<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MobileNumber extends Model
{
    protected $guarded = [];

    /**
     * Check if number is a correct ZA mobile number
     * @param $num String
     */
    static public function isCorrect($num) {
        return (!preg_match("/^(\+?27|0)[6-8][0-9]{8}$/", $num)) ? false : true;
    }

    /**
     * Validates incorrect ZA mobile number
     * @param $num String
     */
    static public function validateNumber($num) {
        $notes = '';
        if (!self::isCorrect($num)) {
            // Check if has only numbers
            if (preg_match('/[^0-9\s\+]/', $num)) {
                $notes .= 'Only numbers are accepted';
            }
            // Check if starts with 27
            if (!preg_match('/^27\d*/', $num)) {
                $notes .= ' the number should begin with 27 in south africa';
            }
            // Check if has more than 11 chars
            if (is_numeric($num) && strlen($num) !== 11) {
                $notes .= ' the numbers must be 11 digits long';
            }
            if (!is_numeric($num) && strlen($num) !== 11) {
                // Attempt to correct number
                $correctedNumber = preg_replace("~\D~", "", $num);
                $correctedNumber = substr($correctedNumber, 0, 11);
                // If the format is correct assign new number
                if (self::isCorrect($correctedNumber)) {
                    $num = $correctedNumber;
                    $notes = "The number wasn't 11 digit long and there was letters and characters";
                }
            }
        }

        // Return array with number and notes
        return array(
            'number' => $num,
            'is_correct' => self::isCorrect($num),
            'notes' => $notes
        );

    }

}
