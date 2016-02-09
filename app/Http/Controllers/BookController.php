<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;


use App\Book;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use View;
use Excel;

class BookController extends Controller
{
    //
    public function index()
    {
      # code...
      $books = Book::all();

      return View::make('index')->with('books', $books);
    }

    public function addBook()
    {
      $rules = array(
          'title'    => 'required|min:1',
          'author'   => 'required|min:1'
      );

      $validator = Validator::make(Input::all(), $rules);

      if ($validator->fails()) {
          return Redirect::to('/')
              ->withErrors($validator)
              ->withInput();
      } else {
        $data = array(
            'title'  => Input::get('title'),
            'author'  => Input::get('author')
        );

        $book = new Book;

        //$book->title = $data['title'];
        //$book->author = $data['author'];

        $book->fill($data);

        $book->save();

        // validation not successful, send back to form
        //return View::make('index', ['books' => Books::all()]);
        return Redirect::to('/');
      }
    }

    public function removeBook($id)
    {
      $book = Book::find($id);
      $book->delete();
      return Redirect::to('/');
    }

    public function importBooks()
    {
      $file = Input::file('csvfile');
      try{
        Excel::load($file, function($reader) {
            $results = $reader->all();
            foreach($results as $row) {
              $book = new Book;

              $data = array(
                  'title'  => $row->title,
                  'author'  => $row->author
              );

              $book->fill($data);

              $book->save();

            }
        });
      } catch (Exception $e) {
        return Redirect::to('/')->with(['books' => Book::all(), 'errors' => $e->getMessage()]);
      }

      return Redirect::to('/')->with(['books' => Book::all()]);
      //return Redirect::to('/')->with('csvdata', $results);
    }
}
