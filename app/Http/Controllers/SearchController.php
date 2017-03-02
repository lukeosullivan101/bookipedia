<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;

class SearchController extends Controller
{
    public function index(Request $request){
    	$books = Book::search($request->search)->get();
    	
    	return view('books.search', [
    			'books' => $books,
    		]);
    }
}
