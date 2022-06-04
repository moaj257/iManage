<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\ApiResponser;
use App\Models\Manufacturer;
use Validator;

class ManufacturerController extends Controller
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
        $overallData = Manufacturer::withTrashed()->count();
        $data = ['data' => [
            'items' => Manufacturer::withTrashed()->skip($skip)->take(10)->get(),
            'pageInfo' => [
                'hasNextPage' => $overallData > ($skip + 10),
                'hasPreviousPage' => $page > 1,
                'lastPage' => (ceil($overallData / 10) < 1) ? 1 : ceil($overallData / 10),
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
    public function create(Request $request) {
        // 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $validator = Validator::make($request->all(), ['name' => ['required', 'unique:manufacturers', 'max:255']]);
        if($validator->fails()) {
            $data = ['errors' => $validator->errors()->all()];
            return $this->send('Validation failed!', $data, 400);
        }

        $manufacturer = new Manufacturer();
        $manufacturer->name = $request->name;
        $manufacturer->save();
        $data = [
            'data' => [
                'item' => $manufacturer
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
    public function show($id) {
        $validator = Validator::make(['id' => $id], [
            'id' => ['required', 'exists:manufacturers,id']
        ]);
        if($validator->fails()) {
            $data = ['errors' => $validator->errors()->all()];
            return $this->send('Validation failed!', $data, 400);
        }

        $manufacturer = Manufacturer::withTrashed()->find($id);
        $data = [
            'data' => [
                'item' => $manufacturer
            ]
        ];
        return $this->send('Success', $data, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $validator = Validator::make(array_merge($request->all(), ['id' => $id]), [
            'id' => ['required', 'exists:manufacturers,id'],
            'name' => ['required', 'unique:manufacturers,name,'.$id, 'max:255'],
            'active' => ['sometimes', 'boolean']
        ]);
        if($validator->fails()) {
            $data = ['errors' => $validator->errors()->all()];
            return $this->send('Validation failed!', $data, 400);
        }

        $manufacturer = Manufacturer::withTrashed()->find($id);
        $manufacturer->name = $request->name;
        if($request->active) {
            $manufacturer->deleted_at = null;
        }
        $manufacturer->save();
        $data = [
            'data' => [
                'item' => $manufacturer
            ]
        ];
        return $this->send('Updated Successfully', $data, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $validator = Validator::make(['id' => $id], [
            'id' => ['required', 'exists:manufacturers,id']
        ]);
        if($validator->fails()) {
            $data = ['errors' => $validator->errors()->all()];
            return $this->send('Validation failed!', $data, 400);
        }

        Manufacturer::withTrashed()->find($id)->delete();
        $data = [];
        return $this->send('Deleted Successfully', $data, 200);
    }
}
