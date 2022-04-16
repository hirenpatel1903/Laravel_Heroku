<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\admin\BaseController;
use Illuminate\Support\Facades\Http;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;

class BookController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.book.index');
    }

    /* Book Listing Start */
    public static function postBooksList(Request $request){
        try{
           return Book::postBooksList($request);
        }catch(\Exception $e){
            session()->flash('error',$e->getMessage());
            return redirect()->route('book.index');
        }
    }
    /* Book Listing End */

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
    public function store(Request $request)
    {
        try{

            Book::truncate();
            $response = Http::get('https://run.mocky.io/v3/821d47eb-b962-4a30-9231-e54479f1fbdf');
            // $jsonData = [];
            $jsonData = $response->json('items');

            if(!empty($jsonData) && count($jsonData) > 0){
                foreach($jsonData as $key=>$jsonDataEL){
                    // dd($jsonData,$key,$jsonDataEL);
                    Book::create([
                        'book_id' => $jsonDataEL['id'] ?? '',
                        'user_id' => Auth::user()->id,
                        'authors' => $jsonDataEL['volumeInfo']['authors'][0] ?? '',
                        'title' => $jsonDataEL['volumeInfo']['title'] ?? '',
                        'subtitle' => $jsonDataEL['volumeInfo']['subtitle'] ?? '',
                        'smallThumbnail' => $jsonDataEL['volumeInfo']['imageLinks']['smallThumbnail'] ?? '',
                        'thumbnail' => $jsonDataEL['volumeInfo']['imageLinks']['thumbnail'] ?? '',
                        'publishedDate' => date(config('const.databaseStoredDateFormat'),strtotime($jsonDataEL['volumeInfo']['publishedDate'] ?? '')) ?? ''
                    ]);
                }

                session()->flash('success', trans('messages.bookUpdate'));
                return redirect()->route('book.index');
            }else{
                session()->flash('error', trans('messages.clearBookDatadecease'));
                return redirect()->route('book.index');
            }
        }catch(\Exception $e){
            session()->flash('error',$e->getMessage());
            return redirect()->route('book.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $data = Book::getBookDetails($id);
            return view('admin.book.show',compact('data'));
        }catch(\Exception $e){
            session()->flash('error',$e->getMessage());
            return redirect()->route('book.index');
        }
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
