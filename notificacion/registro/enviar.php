<?PHP
require_once("../../login/check.php");
$Titulo=$_POST['Titulo'];
$Contenido=$_POST['Contenido'];
$Url=$_POST['Url'];
$TextoBoton1=$_POST['TextoBoton1'];
$TextoBoton2=$_POST['TextoBoton2'];
$Icono1=$_POST['Icono1'];
$Icono2=$_POST['Icono2'];
$Url1=$_POST['Url1'];
$Url2=$_POST['Url2'];

// echo $app_id;
// echo $app_key;
function sendMessage($Titulo,$Contenido,$Url,$TextoBoton1,$TextoBoton2,$Icono1,$Icono2,$Url1,$Url2) {
    global $app_id,$app_key;
    $content      = array(
        "en" => $Contenido,
        "es" => $Contenido
    );
    $headings      = array(
        "en" => $Titulo,
        "es" => $Titulo

    );
    $hashes_array = array();
    if($TextoBoton1!=""){

        array_push($hashes_array, array(
            "id" => "button-1",
            "text" => $TextoBoton1,
            "icon" => $Icono1,
            "url" => $Url1
        ));
    }
    if($TextoBoton2!=""){
        array_push($hashes_array, array(
            "id" => "button-2",
            "text" => $TextoBoton2,
            "icon" => $Icono2,
            "url" => $Url2
        ));
    }

    $fields = array(
        'app_id' => $app_id,
        'included_segments' => array(
            'All'
        ),

        'contents' => $content,
        'headings'=>$headings,
        'web_buttons' => $hashes_array,


    );
    if($Url!=""){
        $fields['url']=$Url;
    }

    $fields = json_encode($fields);
    // print("\nJSON sent:\n");
    // print($fields);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json; charset=utf-8',
        'Authorization: Basic '.$app_key
    ));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

    $response = curl_exec($ch);
    curl_close($ch);

    return $response;
}

$response = sendMessage($Titulo,$Contenido,$Url,$TextoBoton1,$TextoBoton2,$Icono1,$Icono2,$Url1,$Url2);
$return["allresponses"] = $response;
$return = json_encode($return);

$data = json_decode($response, true);
// print_r($data);
$id = $data['id'];
// print_r($id);

// print("\n\nJSON received:\n");
// print($return);
// print("\n");

?>
<div class="alert alert-success">Mensaje Enviado</div>