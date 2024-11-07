<?php

   namespace App\Http\Controllers;

   use App\Models\Patient;
   use Illuminate\Http\Request;

   class PatientController extends Controller
   {
        public function show(Patient $patient)
        {
            return view('patients.show', compact('patient'));
        }

   }