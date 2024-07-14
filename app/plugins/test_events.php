<?
//API URL
$url = 'https://procesos.notificadorjudicial.com/app/plugins/pac_event.php';

//create a new cURL resource
$ch = curl_init($url);

//setup request to send json via POST
$data = array(
			"event" => "transaction.updated",
			"data" => array(
				"transaction" => array(
					"id" => "1509-1588175641-37844",
			        "amount_in_cents" => 4490000,
			        "reference" => "MZQ3X2DE2SMX",
			        "customer_email" => "juan.perez@gmail.com",
			        "currency" => "COP",
			        "payment_method_type" => "NEQUI",
			        "redirect_url" => "https =>//mitienda.com.co/pagos/redireccion",
			        "status" => "APPROVED",
			        "shipping_address" => null,
			        "items" => null,
			        "payment_link_id" => null
				)
			),
			"sent_at" => "2018-07-20T16:45:05.000Z" );
$payload = json_encode($data);

//attach encoded JSON string to the POST fields
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

//set the content type to application/json
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

//return response instead of outputting
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

//execute the POST request
$result = curl_exec($ch);
echo $result;
//close cURL resource
curl_close($ch);

?>