<?php

namespace App\Http\Controllers;

use App\MobileNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MobileNumberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $correctNumbers = MobileNumber::where('correctness', '=', 1)->get();
        $incorrectNumbers = MobileNumber::where('correctness', '=', 0)->get();
        $numbers = MobileNumber::get();
        return view('welcome', compact('correctNumbers', 'incorrectNumbers', 'numbers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'csv_file' => ['required', 'mimes:csv,txt']
        ]);

        $request->file('csv_file')->storeAs('public/uploads', 'csv_upload_' .time() . '.csv');
        $CSVpath = public_path('storage/uploads') . '/csv_upload_' . time() . '.csv';

        // Import mobile numbers to the DB
        $row = 1;
        if (($handle = fopen($CSVpath, "r")) !== false) {
            while (($column = fgetcsv($handle, 1000, ",")) !== false) {
                // Skip CSV header
                if ($row !== 1) {
                    $number = $column[1];

                    // Validate and attempt to correct invalid numbers
                    $validator = MobileNumber::validateNumber($number);

                    // Add phone number if doesn't exist
                    MobileNumber::firstOrCreate([
                        'number' => $validator['number'],
                        'correctness' => $validator['is_correct'],
                        'notes' => $validator['notes']
                    ]);
                }
                $row++;
            }
            fclose($handle);
        }

        return redirect('/');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MobileNumber  $mobileNumber
     * @return \Illuminate\Http\Response
     */
    public function show(MobileNumber $mobileNumber )
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MobileNumber  $mobileNumber
     * @return \Illuminate\Http\Response
     */
    public function edit(MobileNumber $mobileNumber)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MobileNumber  $mobileNumber
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MobileNumber $mobileNumber)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MobileNumber  $mobileNumber
     * @return \Illuminate\Http\Response
     */
    public function destroy(MobileNumber $mobileNumber)
    {
        //
    }
}
