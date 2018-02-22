<?php

use App\Src\CreditCardProcessor;
use PHPUnit\Framework\TestCase;


class CreditCardProcessorTest extends  TestCase{


    var $processor;

    public function setup(){

    }





    /**
     * @expectedException     InvalidArgumentException
     * @dataProvider provideDataForCheckCardForInvalidParams
     */
    public function testValidateCardNumberInputForInvalidParams($expectedException,$cardNo){

        $this->expectException($expectedException);
        $processor =  new CreditCardProcessor($cardNo);
        $processor->validateCardNumberInput();

    }


    public function provideDataForCheckCardForInvalidParams()
    {
        return [
            ['InvalidArgumentException', null],
            ['InvalidArgumentException', 'some'],
            ['InvalidArgumentException', ''],

        ];
    }


    /**
     * @param $expectedException
     * @param $cardNo
     * @dataProvider provideDataForValidateCardNumberInput
     */
    public function testValidateCardNumberInput($cardNo){
        $processor =  new CreditCardProcessor($cardNo);
        $results = @$processor->validateCardNumberInput();
        $this->assertTrue($results);

    }


    public function provideDataForValidateCardNumberInput(){
        return [
            [378282246310005],//Got it from paypal
            [371449635398431],//Got it from paypal
            [5555555555554444],//Got it from paypal

        ];
    }

/**
@dataProvider  provideDataForTestCheckCardNumber
 */
    public function testCheckCardNumber($number,$expected){


        $processor =  new CreditCardProcessor($number);
        $results = $processor->validateCardNumber();

        $this->assertEquals($results,$expected);
    }

    public function provideDataForTestCheckCardNumber(){

        return [
           [1274,false],
           [1284,false],
           [1074,false],
           [4012888888881882,false],
           [4012888888881881,true],
           [378282246310005,true],//Got it from paypal
           [371449635398431,true],//Got it from paypal
           [5555555555554444,true],//Got it from paypal
           [5019717010103742,true],//Got it from paypal

        ];
    }


    /**
     *
     * @dataProvider provideDataForCardProcessedMessage
     */

    public function testCardProcessedMessage($cardNumber,$expctedMessage){


        $processor =  new CreditCardProcessor($cardNumber);
         $message = $processor->cardProcessedMessage();
        $this->assertSame($message,$expctedMessage);
    }


    public function provideDataForCardProcessedMessage(){

        return [
            [1274,"Credit Card 1274 is not valid."],
            [null,"Credit Card  is not valid."],
            [1284,"Credit Card 1284 is not valid."],
            [1074,"Credit Card 1074 is not valid."],
            [4012888888881882,"Credit Card 4012888888881882 is not valid."],
            [4012888888881881,"Credit Card 4012888888881881 is valid."],
            [378282246310005,"Credit Card 378282246310005 is valid."],//Got it from paypal
            [371449635398431,"Credit Card 371449635398431 is valid."],//Got it from paypal
            [5555555555554444,"Credit Card 5555555555554444 is valid."],//Got it from paypal
            [5019717010103742,"Credit Card 5019717010103742 is valid."],//Got it from paypal
        ];
    }
}

?>