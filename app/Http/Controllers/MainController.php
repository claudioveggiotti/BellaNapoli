<?php
namespace App\Http\Controllers;
use Redirect;
use Auth;
use Input;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\AuthAccess\AuthorizesRequests;
use Illuminate\Foundation\AuthAccess\AuthorizesResources;
use Illuminate\Html\HtmlServiceProvider;

class MainController extends Controller
{

  public function showLogin() {
    return view('user.login')
        ->with(['user' => 'guest', 'merchant' => 0, 'balance' => 0]);
  }


  public function checkLogin() {
    if (auth()->check()) {
        $user = auth()->user();
        return $user;
    } else
        return 'NOT LOGGED';
  }


  public function doLogout() {
    Auth::logout(); // logging out user
    return redirect('product');
  }


  public function showSignUp() {
    // Controllo se c'è già un merchant iscritto
    $merchantExist = 0;
    $userMerchant = DB::select('SELECT * FROM users WHERE merchant = 1');
      if (count($userMerchant) > 0)
        $merchantExist = 1;

    return view('user.signup')
        ->with(['user' => 'guest', 'merchant' => 0, 'balance' => 0, 'merchantExist' => $merchantExist]);
  }

  public function doSignUp(Request $request) {

    $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
    ]);

    $name = $request->input('name');
    $email = $request->input('email');
    $password = $request->input('password');
    $passwordHash = \Hash::make($password);
    $merchant = $request->input('merchant');
    if (!$merchant) $merchant = 0;

    DB::insert('INSERT into users (name, email, password, merchant, balance) values (?,?,?,?,30)',
        [ $name, $email, $passwordHash, $merchant ]
    );
   
    $userdata = array (
        'email' => $email,
        'password' => $password
    );
        
    if (Auth::attempt($userdata)) {
        return redirect('product');
    } else {
        return redirect('signup');
    }

  }

  public function doLogin(Request $request) {

    $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
    ]);

    $email = $request->input('email');
    //$password = \Hash::make($request->input('password'));
    $password = $request->input('password');
    $userdata = array (
        'email' => $email,
        'password' => $password
    );
        
    if (Auth::attempt($userdata)) {
        return redirect('product');
    } else {
        return redirect('login');
    }
  }
}
