<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payment\PagSeguro\CreditCard;

class CheckoutController extends Controller
{
    //
    public function index() {
        if(!auth()->check()){
            return redirect()->route('login');
        }

        if(!session()->has('cart')) return redirect()->route('home');

        $this->makePagSeguroSession();


        $cartItens = array_map(function($line){
            return $line['amount'] * $line['price'];
        }, session()->get('cart'));

        $cartItens = array_sum($cartItens);
        
        return view('checkout', compact('cartItens'));
    }

    public function proccess(Request $request){   
        try{
            
            $dataPost = $request->all();
            $user = auth()->user();
            $cartItens = session()->get('cart');
            $reference = 'aaa';

            $creditCardPayment = new CreditCard($cartItens, $user, $dataPost, $reference);
            $result = $creditCardPayment->doPayment();



            $userOrder = [
                'reference' => $reference,
                'pagseguro_code' => $result->getCode(),
                'pagseguro_status' => $result->getStatus(),
                'items' => serialize($cartItens),
                'store_id' => 42,
            ];

            $user->orders()->create($userOrder);

            session()->forget('cart');
            session()->forget('pagseguro_session_code');

            return response()->json([
                'data'=>[
                    'status' => true,
                    'message' => 'Pedido criado com sucesso.'
                ]                
            ]);
        } catch(\Exception $e){
            $message = env('APP_DEBUG') ? $e->getMessage() : 'Erro ao criar pedido';
            return response()->json([
                'data'=>[
                    'status' => false,
                    'message' => $message,
                    'order' => $reference
                ]
            ], 401);
        }
    }

    public function thanks(){
        return view('thanks');
    }

    private function makePagSeguroSession(){
        if(!session()->has('pagseguro_session_code')){
            $sessionCode = \PagSeguro\Services\Session::create(
                \PagSeguro\Configuration\Configure::getAccountCredentials()
            );
            session()->put('pagseguro_session_code', $sessionCode->getResult());
        }
    }
}
