<?php

// defining Namespace
namespace App\Http\Controllers\Admin;

// using Laravel Facades
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

// using Models
use App\Flat;
use App\Option;
use App\Image;

class FlatController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::id();
        $flats = Flat::where('user_id', $user_id)->get();

        return view('admin.flats.index', compact('flats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $options = Option::all();

        return view('admin.flats.create', compact('options'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $request->validate(
            [
              'title' => 'required|string|unique:flats|between:3,255',
              'active' => 'required|boolean',
              'number_of_rooms' => 'required|integer|between:1,254',
              'number_of_beds' => 'required|integer|between:1,254',
              'number_of_bathrooms' => 'required|integer|between:1,254',
              'mq' => 'required|integer|between:1,65000',
              'price' => 'required|numeric|between:1,9999',
              'type' => 'required|string|in:appartamento,villetta|max:30',
              'description' => 'required|string|between:3,65000',
              //TODO extra options
              'street_name' => 'required|string|between:1,255',
              'zip_code' =>'required|integer|digits:5',
              'city' => 'required|string|between:1,255',
              'lat' => 'required|string|between:1,10',
              'lng' => 'required|string|between:1,11',
              'options' => 'array|exists:options,id',
              'images' => 'image',
            ]
        );

        $newFlat = new Flat;

        $newFlat->user_id = Auth::id();
        $newFlat->title = $data['title'];
        $newFlat->slug = Str::slug($newFlat->title, '-');
        $newFlat->active = $data['active'];
        $newFlat->number_of_rooms = $data['number_of_rooms'];
        $newFlat->number_of_beds = $data['number_of_beds'];
        $newFlat->number_of_bathrooms = $data['number_of_bathrooms'];
        $newFlat->mq = $data['mq'];
        $newFlat->price = $data['price'];
        $newFlat->type = $data['type'];
        $newFlat->description = $data['description'];
        $newFlat->stars = rand(1,10);

        if (isset($data['extra_options']))
        {
            $options = implode(', ', $data['extra_options']);
            $newFlat->extra_options = $options;
        }

        $newFlat->street_name = $data['street_name'];
        $newFlat->zip_code = $data['zip_code'];
        $newFlat->city = $data['city'];
        $newFlat->lat = $data['lat'];
        $newFlat->lng = $data['lng'];

        $newFlat->save();

        if (isset($data["options"]))
        {
            $newFlat->options()->sync($data["options"]);
        }

        if (isset($data["images"]))
        {
            $imagePath = Storage::disk("public")->put("images", $data["images"]);

            $newImage = new Image;
            $newImage->index = 1;
            $newImage->flat_id = $newFlat->id;
            $newImage->path = $imagePath;

            $newImage->save();
        }

        return redirect()->route('guest.flats.show', $newFlat->slug);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string $slug
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $user_id = Auth::id();
        $options = Option::all();
        $flat = Flat::where([
                              ['slug', $slug],
                              ['user_id', $user_id]
                            ])->first();

        $data = [
          'flat' => $flat,
          'options' => $options
        ];

        return view('admin.flats.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string $slug
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $data = $request->all();

        $flat = Flat::where('slug', $slug)->first();

        $request->validate(
            [
              "title" => [
                  "required",
                  Rule::unique('flats')->ignore($flat),
                  "max:255",
              ],
              'active' => 'required|boolean',
              'number_of_rooms' => 'required|integer|between:1,254',
              'number_of_beds' => 'required|integer|between:1,254',
              'number_of_bathrooms' => 'required|integer|between:1,254',
              'mq' => 'required|integer|between:1,65000',
              'price' => 'required|numeric|between:1,9999',
              'type' => 'required|string|in:appartamento,villetta|max:30',
              'description' => 'required|string|between:3,65000',
              //extra options
              'street_name' => 'required|string|between:1,255',
              'zip_code' =>'required|integer|digits:5',
              'city' => 'required|string|between:1,255',
              'lat' => 'required|string|between:1,10',
              'lng' => 'required|string|between:1,11',
              'options' => 'array|exists:options,id',
              'images' => 'image',
            ]
        );

        $flat = Flat::where('slug', $slug)->first();

        $flat->user_id = Auth::id();
        $flat->title = $data['title'];
        $flat->active = $data['active'];
        $flat->number_of_rooms = $data['number_of_rooms'];
        $flat->number_of_beds = $data['number_of_beds'];
        $flat->number_of_bathrooms = $data['number_of_bathrooms'];
        $flat->mq = $data['mq'];
        $flat->price = $data['price'];
        $flat->type = $data['type'];
        $flat->description = $data['description'];
        $flat->stars = rand(1,10);

        if (isset($data['extra_options']))
        {
            $options = implode(', ', $data['extra_options']);
            $flat->extra_options = $options;
        }

        $flat->street_name = $data['street_name'];
        $flat->zip_code = $data['zip_code'];
        $flat->city = $data['city'];
        $flat->lat = $data['lat'];
        $flat->lng = $data['lng'];

        $flat->update();

        if (isset($data["options"]))
        {
            $flat->options()->sync($data["options"]);
        }

        return redirect()->route('guest.flats.show', $flat->slug);
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string $slug
     * @return \Illuminate\Http\Response
     */
    public function update_status(Request $request, $slug)
    {

        $flat = Flat::where('slug', $slug)->first();

        if ($flat->active) {
          $flat->active = 0;
        } else {
          $flat->active = 1;
        }

        $flat->update();

        // TODO add a toast notification 'Appartamento aggiornato'
        return redirect()->route('admin.flats.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string $slug
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $user_id = Auth::id();
        $flat = Flat::where('slug', $slug)->where('user_id', $user_id)->first();
        $flat->delete();

        return redirect()->route('admin.flats.index');
    }
}
