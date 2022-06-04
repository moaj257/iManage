<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\ApiResponser;
use App\Models\Condition;
use Validator;

class ConditionController extends Controller
{
    use ApiResponser;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $page = (int) $request->page ? $request->page : 1;
        $skip =  ($page - 1) * 10;
        $overallData = Condition::count();
        $data = ['data' => [
            'items' => Condition::skip($skip)->take(10)->get(),
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
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'unique:conditions', 'max:255']
        ]);
        if($validator->fails()) {
            $data = ['errors' => $validator->errors()->all()];
            return $this->send('Validation failed!', $data, 400);
        }

        $condition = new Condition();
        $condition->name = $request->name;
        $condition->save();
        $data = [
            'data' => [
                'item' => $condition
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
            'id' => ['required', 'exists:conditions,id']
        ]);
        if($validator->fails()) {
            $data = ['errors' => $validator->errors()->all()];
            return $this->send('Validation failed!', $data, 400);
        }

        $condition = Condition::withTrashed()->find($id);
        $data = [
            'data' => [
                'item' => $condition
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
    public function update(Request $request, $id) {
        $validator = Validator::make(array_merge($request->all(), ['id' => $id]), [
            'id' => ['required', 'exists:conditions,id'],
            'name' => ['required', 'unique:conditions,name,'.$id, 'max:255'],
            'active' => ['sometimes', 'boolean']
        ]);
        if($validator->fails()) {
            $data = ['errors' => $validator->errors()->all()];
            return $this->send('Validation failed!', $data, 400);
        }

        $condition = Condition::withTrashed()->find($id);
        $condition->name = $request->name;
        if($request->active) {
            $condition->deleted_at = null;
        }
        $condition->save();
        $data = [
            'data' => [
                'item' => $condition
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
            'id' => ['required', 'exists:conditions,id']
        ]);
        if($validator->fails()) {
            $data = ['errors' => $validator->errors()->all()];
            return $this->send('Validation failed!', $data, 400);
        }

        Condition::withTrashed()->find($id)->delete();
        $data = [];
        return $this->send('Deleted Successfully', $data, 200);
    }
}
