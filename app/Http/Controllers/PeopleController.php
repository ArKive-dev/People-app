<?php

namespace App\Http\Controllers;

use App\Models\People;
use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class PeopleController extends Controller
{

    public function index()
    {

        $people = Person::paginate(3);

    return view('database', [
        'People' => $people,
    ]);

    }

    public function store()
    {
        $data = request()->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'lname' => 'required|min:3'
        ]);

        $person = new Person();
        $person->name = request('name');
        $person->lname = request('lname');
        $person->email = request('email');
        $person->save();

        return back();
    }

    public function destroy(string $id)
    {
        $person = Person::findOrFail($id);
        $person->delete();

        return back();
    }

    public function update(Request $request, Person $person)
    {
        $data = $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'lname' => 'required|min:3'
        ]);

        $person->update($data);

        return redirect()->route('database')->with('success', 'Person updated successfully.');
    }


    public function search(Request $request)
{
    $searchQuery = $request->input('search');

    $people =  Person::where('name', 'LIKE', '%' . $searchQuery . '%')
        ->orWhere('lname', 'LIKE', '%' . $searchQuery . '%')
        ->orWhere('email', 'LIKE', '%' . $searchQuery . '%')
        ->paginate(3);

        return view('database', [
            'People' => $people
        ]);
}


}

