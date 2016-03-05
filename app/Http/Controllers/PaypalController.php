<?php

namespace TuFracc\Http\Controllers;

//require __DIR__ .'/vendor/autoload.php';
require '..\vendor\autoload.php';

$apiContext = new \PayPal\Rest\ApiContext(
    new \PayPal\Auth\OAuthTokenCredential(
    'AbY2sudkGMJvjkjLpJ041FSnefC-qNAT2YC6gcFczZuIqjIzJPSNrKU_1qgQkriX53PURH0OTrsndXxK', // ClientID
    'EJCUhai8sQaFsiO6utCJBImMJYZUcNTXdP7J99kIsGV4AI_6pXQp6DlV0zAUhehVQBD_fm_3Ej0G_hwZ' // ClientSecret  
    )
);

use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;

use TuFracc\User;
use TuFracc\Pagos;
use TuFracc\Cuotas;

use TuFracc\Http\Requests;
use TuFracc\Http\Controllers\Controller;
use Redirect;
use DB;
use Illuminate\Contracts\Auth\Guard;
use Closure;
use Session;

class PaypalController extends BaseController
{
	protected $auth;
    private $_api_context;
    
	public function __construct(Guard $auth)
	{
		// setup PayPal api context
		$paypal_conf = \Config::get('paypal');
		$this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
		$this->_api_context->setConfig($paypal_conf['settings']);

		$this->auth = $auth;
	}


public function postPayment($type){

		\Session::forget('pagos_id');
		$pagos_id = \Session::get('pagos_id');
		//\Session::put('pagos_id', $pagos_id);

		\Session::forget('pagos_data');
		$pagos_data = \Session::get('pagos_data');
		//\Session::put('pagos_data', $pagos_data);

		$user_id = $this->auth->user()->id;
		$month = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

		$cta = $this->auth->user()->type;
		$cuota = Cuotas::find(2);

		$payer = new Payer();
		$payer->setPaymentMethod('paypal');

		$items = array();
		$subtotal = 0;
		$currency = 'MXN';

		$price=$cuota->amount;
		$descuento=false;
		$discount= -$price;
		$qty = 1;
		$shipp = 0;

		$items_arr = array();

		$pago_hasta = 0;
		$lmt=0;
		$m=1; //mes de inicio 1-12
		$y=2016; //año de inicio
		$d=date('d');


		$ultimo_p = DB::table('pagos')->where('id_user', $this->auth->user()->id)->where('status', 1)->orderBy('date', 'dsc')->get();

		foreach ($ultimo_p as $pay) {
			$pago_hasta = explode("-", $pay->date); 
			$m = intval($pago_hasta[1]);
			$y = intval($pago_hasta[0]);
			$m++;
			if ($m==13) {
				$m=1;
				$y++;
			}
			break;
		}
			
		$prueba='';
		// 1-mensual
		// 2-semestral
		// 3-anual
		// 4-saldo vencido
		if($type==1){
			$lmt=1;
		}else if($type==2){
			$lmt=6;
		}else if ($type==3){
			$lmt=12;
			$descuento=true;		
		}else if ($type==4){
			$vencidos = DB::table('pagos')->where('id_user', $this->auth->user()->id)->where('status', 0)->orderBy('date', 'asc')->get();
			$vence_date = explode("-", $vencidos[0]->date);
			$m=intval($vence_date[1]);
			$y=intval($vence_date[0]);
			//[0]2014 [1]mes [2]dia 
			foreach ($vencidos as $vence) {
				$pagos_id[] = $vence->id;
				\Session::put('pagos_id', $pagos_id);
	  			$lmt++;
			}	
		}

		//populate items array
		for ($i=0; $i < $lmt ; $i++){ 
			$items_arr[$i] = $month[$m-1] . " " . $y;

			//se llena con fechas -> yyyy-mm-dd
			if($m<10){
				$pagos_data[$i] = $y . '-0' . $m . '-' . $d;
				\Session::put('pagos_data', $pagos_data); 
			}else{
				$pagos_data[$i] = $y . '-' . $m . '-' . $d; 
				\Session::put('pagos_data', $pagos_data); 
			}
			$m++;
			if($m==13){
				$m=1;
				$y++;
			}
		}
		
		//crear los items
		foreach ($items_arr as $pago) {
			$item = new Item();
					$item->setName($pago)
						->setCurrency($currency)
						->setDescription('item description')
						->setQuantity($qty)
						->setPrice($price);
					$items[] = $item;
					$subtotal += $price * $qty;
		}

		//descuento
		if($descuento){
			$item = new Item();
				$item->setName('Descuento Pago Anual(1 mes)')
					->setCurrency($currency)
					->setDescription('item description')
					->setQuantity($qty)
					->setPrice($discount);
				$items[] = $item;
				$subtotal += $discount * $qty;
		}

		$item_list = new ItemList();
		$item_list->setItems($items);
		
		$details = new Details();
		$details->setSubtotal($subtotal)
			->setShipping($shipp);

		$total = $subtotal + $shipp;
		$amount = new Amount();
		$amount->setCurrency($currency)
			->setTotal($total)
			->setDetails($details);


		$transaction = new Transaction();
		$transaction->setAmount($amount)
			->setItemList($item_list)
			->setDescription('Pedido de prueba en mi Laravel App');

		$redirect_urls = new RedirectUrls();
		$redirect_urls->setReturnUrl(\URL::route('payment.status'))
			->setCancelUrl(\URL::route('payment.status'));

		$payment = new Payment();
		$payment->setIntent('sale')
			->setPayer($payer)
			->setRedirectUrls($redirect_urls)
			->setTransactions(array($transaction));
/*		
		try {
			$payment->create($this->_api_context);
		} catch (PayPal\Exception\PayPalConnectionException $ex) {
		    //echo $ex->getCode(); // Prints the Error Code
		    //echo $ex->getData(); // Prints the detailed error message 
		    die($ex);
		} catch (Exception $ex) {
		    die($ex);
		}
*/
		try {
			$payment->create($this->_api_context);
		} catch (\PayPal\Exception\PPConnectionException $ex) {
			if (\Config::get('app.debug')) {
				echo "Exception: " . $ex->getMessage() . PHP_EOL;
				$err_data = json_decode($ex->getData(), true);
				exit;
			} else {
				die('Ups! Algo salió mal');
			}
		}
		
		foreach($payment->getLinks() as $link) {
			if($link->getRel() == 'approval_url') {
				$redirect_url = $link->getHref();
				break;
			}
		}

		// add payment ID to session
		\Session::put('paypal_payment_id', $payment->getId());
		if(isset($redirect_url)) {
			// redirect to paypal
			return \Redirect::away($redirect_url);
		}
			return redirect()->to('micuenta')->with('error', 'Ha ocurrido un error. Volver a intentar.');

	} //end postPayment



	public function getPaymentStatus(){

		// Get the payment ID before session clear
		$payment_id = \Session::get('paypal_payment_id');

		// clear the session payment ID
		\Session::forget('paypal_payment_id');
		$payerId = \Input::get('PayerID');
		$token = \Input::get('token');

		//if (empty(\Input::get('PayerID')) || empty(\Input::get('token'))) {
		if (empty($payerId) || empty($token)) {
			return redirect()->to('micuenta')->with('error', 'Hubo un problema al intentar pagar con Paypal');
		}

		$payment = Payment::get($payment_id, $this->_api_context);
		// PaymentExecution object includes information necessary 
		// to execute a PayPal account payment. 
		// The payer_id is added to the request query parameters
		// when the user is redirected from paypal back to your site
		$execution = new PaymentExecution();
		$execution->setPayerId(\Input::get('PayerID'));
		//Execute the payment
		$result = $payment->execute($execution, $this->_api_context);
		//echo '<pre>';print_r($result);echo '</pre>';exit; // DEBUG RESULT, remove it later
		if ($result->getState() == 'approved') { // payment made
			// Registrar el pedido --- ok
			// Registrar el Detalle del pedido  --- ok
			// Enviar correo a user
			// Enviar correo a admin
			// Redireccionar

			// Update de pagos

			$pagos_id = \Session::get('pagos_id');
			$pagos_data = \Session::get('pagos_data');
			$message = 'Su pago ha sido registrado. Gracias.';

			if(!empty($pagos_id)) {
				foreach ($pagos_id as $pago) {
					DB::table('pagos')->where('id', $pago)->update(['status' => 1]);
					DB::table('users')->where('id',$this->auth->user()->id)->update(['status' => 1]);
				}
			}else if(!empty($pagos_data)){
				
				$user = User::find($this->auth->user()->id);
				$cuota = Cuotas::find($user->type);

				foreach ($pagos_data as $date) {
					DB::table('pagos')->insert([
						'id_user' => $user->id,
						'date' => $date,
						'status' => 1,
						'amount' => $cuota->amount,
						'user_name' => $user->name
						]);
				}
				
			}
				
			return redirect()->to('micuenta')->with('message', $message);
		}
		return redirect()->to('micuenta')->with('message', 'El pago ha sido cancelado.');
	}//end getPaymentStatus




} //end doc
