<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class CartCtrl extends Controller
{

    // Controllet per l'inserimento del prodotto nel carrello
    public function addToCart($idProd) {
        $idUser = auth()->id();

        // Inserisco nel carrello il prodotto
        DB::insert(
            'insert into Carrello (user, product, quantity) values (?,?,?)', 
            [ $idUser, $idProd, 1 ]
        );

        // Diminisco la disponibilità per il prodotto inserito nel carrello
        DB::update('update Prodotti set stock = stock -1 where id = ?',
            [ $idProd ]
        );

        return redirect('checkout');   
    }

    public function emptyCart() {
        $idUser = auth()->id();

        // Rimetto i prodotti in disponibilità
        $prodotti = DB::select('SELECT product, count(*) as qty FROM Carrello WHERE user = ? GROUP BY product',
            [ $idUser ]
        );
        
        foreach ($prodotti as $prodotto) {

            $idProd = $prodotto->product;
            $qty = $prodotto->qty;

            DB::update('UPDATE Prodotti SET stock = stock + ? WHERE id = ?',
                [ $qty, $idProd ]
            );

        }

        // Azzero il carrello dell'utente
        DB::delete('DELETE FROM Carrello WHERE user = ?',
            [ $idUser ]
        );

        return redirect('checkout');

    }

    // Controller per la visualizzazione del carrello
    public function checkout() {
        $user = auth()->user();
        $idUser = $user->id;
        $userName = $user->name;
        $merchant = $user->merchant;
        $balance = $user->balance;

        // Creo l'elenco dei prodotti contenuti nel carrello dell'utente loggato
        $prodotti = DB::select('SELECT P.name, P.price FROM Prodotti as P, Carrello as C WHERE C.user = ? and C.product = P.id', 
            [ $idUser ]
        );

        // Calcolo il totale da pagare
        $totale = DB::select('select sum(P.price) as totale FROM Prodotti as P, Carrello as C WHERE C.user = ? and C.product = P.id',
            [ $idUser ]
        );
        $totale = $totale[0]->totale;

        return view('cart.showcart')
            -> with(['user' => $userName, 'merchant' => $merchant, 'prodotti' => $prodotti, 'totale' => $totale, 'balance' => $balance]);
    }


    // Controller per l'acquisto dei prodotti del carrello
    public function buy() {
        $user = auth()->user();
        $idUser = $user->id;
        $userName = $user->name;
        $merchant = $user->merchant;
        $balance = $user->balance;

        // Calcolo il totale da pagare
        $totale = DB::select('select sum(P.price) as totale FROM Prodotti as P, Carrello as C WHERE C.user = ? and C.product = P.id',
            [ $idUser ]
        );
        $totale = $totale[0]->totale;

        if ($totale <= $balance) {

            // Tolgo il totale speso dal balance dell'utente
            DB::update('UPDATE users SET balance = ? WHERE id = ?',
                [ $balance - $totale, $idUser ]
            );

            // Azzero il carrello dell'utente
            DB::delete('DELETE FROM Carrello WHERE user = ?',
                [ $idUser ]
            );

            $esito = 1;

        } else 
            $esito = 0;

        
        return view('cart.buy')
            -> with('esito', $esito);

    }

}
