<?php
/**
 * Process credit card number and state validity
 * @author @cherankrish
 *
 */
namespace App\Src;

class CreditCardProcessor{


    var $cardNumber;

    function __construct($cardNumber){

        $this->cardNumber = $cardNumber;
    }

    public function getCard(){
        return 'hi';
    }

    /**
     *
     * @return bool
     * @throws \InvalidArgumentException
     */

    public function validateCardNumberInput(){

        $cardNumber = $this->cardNumber;

        if(empty($cardNumber) or !is_int($cardNumber)){

            throw new \InvalidArgumentException('Card number must be an integer value');
        }

        return true;
    }

    /**
     *
     * @return bool
     *
     * @author @cherankrish
     */
    public function validateCardNumber( ){

        $cardNumber = $this->cardNumber;
        $carNumberInReverse = (string)strrev($cardNumber);


        $counter = 0;
        $total = 0;

        $cardNumberLength =  strlen($carNumberInReverse) ;

        for($a=0; $a< $cardNumberLength; $a++){

            if($counter == 1 ){
                $secondNumberMultiplied = ((int)$carNumberInReverse[$a] * 2);

                if(strlen((string)$secondNumberMultiplied)>1){

                    $stringVersionOfSecondNumberMultiplied = (string)$secondNumberMultiplied;
                    $addEachNumbers = (int)$stringVersionOfSecondNumberMultiplied[0] + (int)$stringVersionOfSecondNumberMultiplied[1];
                    $total += $addEachNumbers;


                }else{

                    $total += $secondNumberMultiplied;

                }

                $counter = 0;


            }else{


                if($a == 0){
                    $total += $carNumberInReverse[$a];
                }else{
                    $total += (int) $carNumberInReverse[$a] ;

                }

                $counter = 1;
            }


        }

        if( $total%10 == 0){
            return true;
        }

        return false;

    }

    public function cardProcessedMessage(){

        $cardNumber =  $this->cardNumber;

        try{
            $this->validateCardNumberInput();


            if($this->validateCardNumber()){

                return sprintf("Credit Card %d is valid.",$cardNumber);
            }else{
                return sprintf("Credit Card %d is not valid.",$cardNumber);
            }
        }catch (\InvalidArgumentException $e){

            return sprintf("Credit Card %s is not valid.",$cardNumber);
        }


    }
}

?>