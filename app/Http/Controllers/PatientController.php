<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use Illuminate\Support\Facades\DB;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // $patients= Patient::all();
       $patients=DB::table('patients')
       ->join('document_types','patients.documentid','=', 'document_types.documentId')
       ->join('genders','patients.genderId','=', 'genders.genderId')
       ->select('patients.*', 'document_types.description as DOCUMENT_TYPE', 'genders.description AS GENDER')
       ->get();
        return \response($patients);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'documentid'=> 'required',
            'documentnumber'=> 'required',
            'firstname'=> 'required|max:20',
            'secondName',
            'firstlastname',
            'secondlastname'=> 'required|max:20',
            'genderId'=> 'required'
        ]);

        $patient=Patient::create($request->all());

        return \response($patient);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $patient=Patient::findOrFail($id);
        return \response($patient);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $patient=Patient::findOrFail($id)
            ->update($request->all());
        
        $patient_update=Patient::findOrFail($id);

        return \response(content:"El usuario con ID: ".$id." Ha sido Modificado ");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Patient::destroy($id);
        return \response(content:"El paciente con el ID: ".$id." Ha sido eliminado");
    }
}
