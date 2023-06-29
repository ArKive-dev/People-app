<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class PeopleController extends Controller
{

    public function index()
    {

    $customers = Customer::all();

    return view('database', [
        'Customers' => $customers,
    ]);

    }

    public function store()
    {
        $data = request()->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'lname' => 'required|min:3'
        ]);

        $customer = new Customer();
        $customer->name = request('name');
        $customer->lname = request('lname');
        $customer->email = request('email');
        $customer->save();

        return back();
    }

    public function destroy(string $id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return back();
    }

    public function update(Request $request,string $id)
    {
    $customer = Customer::findOrFail($id);

    if($request->has('name')){
        $customer->name = $request->name;
    }
    if($request->has('lname')){
        $customer->lname = $request->lname;
    }
    if($request->has('email')){
        $customer->email = $request->email;
    }
    dd($request);

    $customer->save();
    return back();


    }

    public function search(Request $request)
{
    $searchQuery = $request->input('search');

    $customers = Customer::where('name', 'LIKE', '%' . $searchQuery . '%')
        ->orWhere('lname', 'LIKE', '%' . $searchQuery . '%')
        ->orWhere('email', 'LIKE', '%' . $searchQuery . '%')
        ->get();

        return view('database', [
            'Customers' => $customers,
        ]);
}


}

