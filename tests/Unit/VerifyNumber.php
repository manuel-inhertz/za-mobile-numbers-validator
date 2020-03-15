<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Illuminate\Http\Request;
use App\MobileNumber;

class VerifyNumber extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function verifyNumberTest(Request $request)
    {
        $number = $request['number'];
        return print_r(MobileNumber::validateNumber($number));
    }
}
