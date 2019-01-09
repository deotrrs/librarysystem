<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Book;
use App\Category;
use Validator;
class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::with('category')->get();
        $categories = Category::get();
        return view('books.index', compact('books'), compact('categories'));
    }

    public function archive()
    {
        $books = Book::with('category')->onlyTrashed()->get();
        $categories = Category::get();
        return view('books.archive', compact('books'), compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $categories = Category::get();
        return view('books.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // print_r($request->except(['_token']));
        $valid = Validator::make($request->all(),[
            'title'=>"required",
            'isbn'=>"required",
            'author'=>"required",
            'publisher'=>"required",
            'year'=>"required",
            'category'=>"required",
           ]);
           
           $book = new Book([
               'title'=>$request->title,
               'isbn'=>$request->isbn,
               'author'=>$request->author,
               'publisher'=>$request->publisher,
               'year'=>$request->year,
               'category_id'=>$request->category,
           ]);            
            if($valid->fails()){
                return array(
                'type' => 'error',
                'message' => 'Error!'
                );
            }
            else{
                $book->save();
                return array(
                'type' => 'success',
                'message' => 'Successfully Added!'
                );
            }
            // return();
 
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
    public function edit(Request $request)
    {
        $books = Book::with('category')->find($request->id);
        return $books;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id;
        $valid = Validator::make($request->all(),[
            'title'=>"required",
            'isbn'=>"required",
            'author'=>"required",
            'publisher'=>"required",
            'year'=>"required",
            'category'=>"required",
           ]);
        if ($request->filename) {
            $filename =  $request->filename->getClientOriginalName();
            Storage::disk('public')->putFileAs('images/books', $request->filename, $request->filename->getClientOriginalName());
            $data = [
                'title'=>$request->title,
                'isbn'=>$request->isbn,
                'author'=>$request->author,
                'publisher'=>$request->publisher,
                'year'=>$request->year,
                'category_id'=>$request->category,
                'image_path'=>$filename,
            ];
        }
        else{
           $data=[
                'title'=>$request->title,
                'isbn'=>$request->isbn,
                'author'=>$request->author,
                'publisher'=>$request->publisher,
                'year'=>$request->year,
                'category_id'=>$request->category,
           ];
        }    
        $book = Book::find($id);
        $book->update($data);    
        if($valid->fails()){
        return array(
        'type' => 'error',
        'message' => 'Error!'
        );
        }
        else{
            return array(
            'type' => 'success',
            'message' => 'Successfully Added!'
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {   
        $id=$request->id;
        $books = Book::find($id);
        $books->delete();
        return redirect('books/')->with('success', 'One Book has been deleted Successfully');

    }
}
