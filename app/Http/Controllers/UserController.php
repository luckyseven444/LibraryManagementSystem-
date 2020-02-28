<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\CheckOut;
use App\User;
use App\Book;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $id = Auth::id();
        // Part:1 Any book is taken for the first-time or second time on a row
        $validDates = CheckOut::where('user_id', $id)
                               ->distinct()
                               ->groupBy(['stock_id'])
                               ->get(['stock_id', 'created_at']);
        $notifiable = [];
        foreach ($validDates as $obj){
            $count = Carbon::now()->diffInDays($obj->created_at);
            if($count > 20 && $count < 30 || $count > 50 && $count < 60){
               $notifiable[] = $obj->stock_id;
            };
        }

        $notifications = [];
        foreach ($notifiable as $obj){
           $notifications[]=['title' => \App\Book::find(\App\Stock::find($obj)->book_id)->title,
            'stock_id' => $obj];
        }

        $final=[];
       foreach ($notifications as $item){
           if(\App\Stock::find($item['stock_id'])->status == 1){
             $final = array_diff_assoc($notifications, $item);
           }
       }
       //dd($final);
        //Part one closed

        $books = CheckOut::where('user_id', $id)->with('stocks.book.author')->get();

        return view('user.index', compact(['books', 'final']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        \App\User::where('id', $id)->delete();
        return redirect('admin');
    }
}
