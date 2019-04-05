<?PHP
function sendMessage() {
    $content      = array(
        "en" => 'English Message',
        "es" => 'Tenemos en STOCK Nuevo Producto que puede pasar por nuestras Tiendas  asd asd qwe qweqw eqw eqwe qwe qwe asd xcgdfgdf tet ert  t'
    );
    $headings      = array(
        "en" => 'English Title',
        "es" => 'Nuevo Producto '

    );
    $hashes_array = array();
    array_push($hashes_array, array(
        "id" => "like-button",
        "text" => "Llamar",
        "icon" => "https://addons-media.operacdn.com/media/extensions/25/191325/1.0.2-rev2/icons/icon_64x64_72ed78b63ef549be40b861f3ec0ee4d1.png",
        "url" => "https://wa.me/59173230568"
    ));
    array_push($hashes_array, array(
        "id" => "like-button-2",
        "text" => "Like2",
        "icon" => "http://i.imgur.com/N8SN8ZS.png",
        "url" => "https://yoursite.com"
    ));
    array_push($hashes_array, array(
        "id" => "like-button-2",
        "text" => "Like2",
        "icon" => "http://i.imgur.com/N8SN8ZS.png",
        "url" => "tel://59173230568"
    ));
    $fields = array(
        'app_id' => "111a4032-de45-4f48-994e-801346a9c6dc",
        'included_segments' => array(
            'All'
        ),

        'contents' => $content,
        'headings'=>$headings,
        'web_buttons' => $hashes_array,
        'url'=>'http://www.ronyti.com'
    );

    $fields = json_encode($fields);
    print("\nJSON sent:\n");
    print($fields);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json; charset=utf-8',
        'Authorization: Basic YWE1NjdmZTMtNjk0NC00OTg3LWI4NjgtOGYxMTRhZDY0NWZm'
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

$response = sendMessage();
$return["allresponses"] = $response;
$return = json_encode($return);

$data = json_decode($response, true);
print_r($data);
$id = $data['id'];
print_r($id);

print("\n\nJSON received:\n");
print($return);
print("\n");
?>