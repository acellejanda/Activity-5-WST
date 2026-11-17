<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HRCalculatorController extends Controller
{
     public function calculatePayroll(Request $request)
    {
        $dayAbsent = $request->dayAbsent;

        $baseSalary = 0;

        if($dayAbsent <= 5)
       {
        $baseSalary = 30000;
       }
       else
        {
            $baseSalary = 2500;
        }

         return response()->json([
            'dayAbsent' => $dayAbsent,
        ]);
    }
}
