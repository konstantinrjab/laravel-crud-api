<?php

namespace App\Http\Controllers;

use App\Town;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TownController extends Controller
{
    public function toArrayOne(Town $town)
    {
        return [
            'id' => $town->id,
            'name' => $town->name,
            'created_at' => $town->created_at->toDateTimeString(),
            'updated_at' => $town->updated_at->toDateTimeString(),
        ];
    }
    public function toArrayMany($towns){
        $data = [];
        foreach ($towns as $town){
            $data[] = $this->toArrayOne($town);
        }
        return $data;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json($this->toArrayMany(Town::all()));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->json()->all();
        $validator = Validator::make($data, [
            'townName' => 'required|unique:towns,name'
        ], ['unique' => 'Already added']);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $town = new Town();
        $town->name = $data['townName'];
        if ($town->save()) {
            return response()->json('', 201);
        } else {
            return response()->json('', 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Town $town
     * @return \Illuminate\Http\Response
     */
    public function show(Town $town)
    {
        return response()->json($this->toArrayOne($town));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Town $town
     * @return \Illuminate\Http\Response
     */
    public function edit(Town $town)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Town $town
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Town $town)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Town $town
     * @return \Illuminate\Http\Response
     */
    public function destroy(Town $town)
    {
        $town->delete();
        return response()->json('', 204);
    }
}
