<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use URL;
use App\Helpers\Helper;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Response;

class Book extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'books';
    protected $primaryKey = 'id';
    protected $fillable = [
        'book_id','user_id','authors','title','subtitle','smallThumbnail','thumbnail','publishedDate'
    ];

    /* Admin Book List Start */
    public static function postBooksList($request){
        $query = Book::select('books.*');
        if($request->order ==null){
            $query->orderBy('books.id','desc');
        }

        return Datatables::of($query)
            ->addColumn('action', function ($data) {
               $recoverylink = '';
               if(Auth::user()->role_id == config('const.roleAdmin')){
                   $editLink = '';
                   $deleteLink = '';
               }else{
                   $editLink = '';
                   $deleteLink = '';
                   $recoverylink = '';
               }
               $viewLink = URL::to('/').'/admin/book/'.$data->id;

               return Helper::Action($editLink,$deleteLink,$viewLink,$recoverylink);
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public static function getBookDetails($id){
        $data = Book::find($id);
        return $data;
    }

    public static function activeDepartmentAccountCount(){
        $query = Book::get();
        return $query->count();
    }
}
