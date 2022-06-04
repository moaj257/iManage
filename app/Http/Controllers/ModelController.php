<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\ApiResponser;
use App\Models\Machine;
use Validator;

class ModelController extends Controller
{
    use ApiResponser;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $page = (int) $request->page ?? 1;
        $skip =  ($page - 1) * 10;
        $overallData = Machine::count();
        $data = ['data' => [
            'items' => Machine::skip($skip)->take(10)->get(),
            'pageInfo' => [
                'hasNextPage' => $overallData > ($skip + 10),
                'hasPreviousPage' => $page > 1,
                'lastPage' => ceil($overallData / 10),
                'firstPage' => 1,
                'currentPage' => $page
            ]
        ]];
        return $this->send('Success', $data, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'unique:models', 'max:255'],
            'manufacturer_id' => ['required', 'exists:manufacturers,id', 'max:255']
        ]);
        if($validator->fails()) {
            $data = ['errors' => $validator->errors()->all()];
            return $this->send('Validation failed!', $data, 400);
        }

        $machine = new Machine();
        $machine->name = $request->name;
        $machine->manufacturer_id = $request->manufacturer_id;
        $machine->save();
        $data = [
            'data' => [
                'item' => $machine
            ]
        ];
        return $this->send('Created Successfully', $data, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
