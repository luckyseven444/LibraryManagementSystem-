<?php

namespace App\Http\Controllers;

use App\Book;
use App\Balance;
use App\CheckOut;
use App\Stock;
use Carbon\Carbon;
use Illuminate\Http\Request;

class checkOutController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('checkout.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validation($request);

        $id = $request->user_id;

        //dd($this->balanceCheck($request,$id));

        if (!$this->balanceCheck($request,$id)){
           throw new \App\Exceptions\CheckOutException('Balance mismatch');
        }

        if($this->checkDays($request) && $this->singleSessionBookCount($request,$id) && $this->balanceCheck($request, $id)){

              CheckOut::create([
                  'user_id' => $request->user_id,
                  'stock_id' => $request->stock_id
              ]);
          }
          $this->clearStock($request);
        return redirect('/checkouts/create');
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
        //
    }

    function validation(Request $request)
    {
        return $request->validate([
            'user_id' => 'required',
            'stock_id' => 'required',
        ]);

    }


    //How many books already lent to this user: 3 books max
    function singleSessionBookCount($request,$id){
        $count = CheckOut::where('user_id', $id)->where('stock_id', $request->stock_id)->count();
        if($count >= 2){
           return false;
        }else{
            return true;
        }
    }

    //How much money needed to be deposited further
    function balanceCheck($request, $id){

      if(Balance::all()->contains($id) && CheckOut::all()->contains($id)){

          $balance = Balance::where('user_id', $id)->get()[0]->balance;
          $books = CheckOut::where('user_id', $id)->pluck('stock_id');

          $cumulativePrice = 0;

          foreach ($books as $book ){
              $cumulativePrice += Book::where('id', floor($book))->get()[0]->price;
          }

          $currentBooksPrice = Book::where('id', floor($request->stock_id))->get()[0]->price;

          $finalPrice = $cumulativePrice + $currentBooksPrice;

          if($finalPrice > $balance){
              return false;
          }elseif($finalPrice < $balance){
              return true;
          }elseif($finalPrice == $balance){
              return true;
          }
      }elseif(Balance::all()->contains($id) && !CheckOut::all()->contains($id)){
          $balance = Balance::where('user_id', $id)->get()[0]->balance;

          $currentBooksPrice = Book::where('id', floor($request->stock_id))->get()[0]->price;

          $finalPrice = $currentBooksPrice;

          if($finalPrice > $balance){
              return false;
          }elseif($finalPrice < $balance){
              return true;
          }elseif($finalPrice == $balance){
              return true;
          }
      }
      else {
         return false;
      }

    }

    //Check this book exists in the stock at all
    function bookExistence($request)
    {
      $count = Stock::where('id', $request->stocl_id)->count();
      if(!$count){
           redirect('checkouts/create');
      }
    }

    //How many days this book has been kept by this user
    function checkDays($request)
    {
       //first check this person already checked-out this book for last 30 days
           //This is the first time this guy gonna borrow this book
           $masterObj = CheckOut::where('user_id', $request->user_id)
                        ->where('stock_id', $request->stock_id);

           if($masterObj->count() == 1){
               //Now, calculate how many days back the book was borrowed, if more than 30 days, fines incurred

               $initialdate = $masterObj->get()->last()->created_at;

               $lastDate = new \DateTime($initialdate);

               $now = new \DateTime(Carbon::now());

               $difference = $lastDate->diff($now);

               if($difference->d > 30){
                   //time is over, Incur the fine by schedular and just show a message here
                   return false;
               }elseif($difference->d < 30){
                   //It is okay, this is the first day but user is eligable to borrow second time in a row
                   return true;
               }
           }elseif ($masterObj->count() == null){
               return true;
           }
    }

    public function clearStock($request){
       Stock::find($request->stock_id)->status=0;
    }
}
