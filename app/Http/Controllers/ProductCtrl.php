<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ProductCtrl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->check()) {
            $user = auth()->user();
            $userName = $user->name;
            $merchant = $user->merchant;
            $balance = $user->balance;
        } else {
            $userName = 'guest';
            $merchant = 0;
            $balance = 0;
        }

        if ($merchant == 1)
            $prodotti = DB::select('select * from Prodotti');
        else 
            $prodotti = DB::select('select * from Prodotti where stock>0');

        return view('product.index')
            -> with(['user' => $userName, 'merchant' => $merchant, 'balance' => $balance, 'prodotti' => $prodotti]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'productName' => 'required',
            'productDescr' => '',
            'productPrice' => 'required',
            'productStock' => 'required'
        ]);
        $inputValues =  $request->except('_token');
        DB::insert(
            'insert into Prodotti (name, descr, price, stock) values (?,?,?,?)', 
            [
                $inputValues['productName'],
                $inputValues['productDescr'],
                $inputValues['productPrice'],
                $inputValues['productStock']
            ]
        );
        return redirect('product');   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = DB::select('select * from Prodotti where id=?', [$id]);
        return view('product.edit')
            ->with([
                "id" => $product[0]->id,
                "name" => $product[0]->name,
                "descr" => $product[0]->descr,
                "price" => $product[0]->price,
                "stock" => $product[0]->stock
            ]);
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
         $this->validate($request, [
            'productName' => 'required',
            'productDescr' => '',
            'productPrice' => 'required',
            'productStock' => 'required'
        ]);
        $inputValues =  $request->except('_token');
        DB::update(
            'update Prodotti set name = ?, descr = ?, price = ?, stock = ? where id= ?', 
            [
                $inputValues['productName'],
                $inputValues['productDescr'],
                $inputValues['productPrice'],
                $inputValues['productStock'],
                $id
            ]
        );
        return redirect('product');   
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
