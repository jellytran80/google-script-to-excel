
function callAPI($method, $url, $data)
{

    $curl = curl_init();
    switch ($method) {
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);
            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            break;
        case "PUT":
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            break;
        default:
            if ($data)
                $url = sprintf("%s?%s", $url, http_build_query($data));
    }
    // OPTIONS:
    $timeout = 0; // set to zero for no timeout
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, $timeout);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
    // curl_setopt($curl, CURLOPT_URL, $url);
    // curl_setopt($curl, CURLOPT_HTTPHEADER, array(
    //     'APIKEY: 111111111111111111111',
    //     'Content-Type: application/json',
    // ));
    // curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    // curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    // EXECUTE:
    $result = curl_exec($curl);
    if (!$result) {
        die("Connection Failure");
    }
    curl_close($curl);
    return $result;
}
// Using with Wordpress
// $url_api = 'https://script.google.com/macros/s/<google_key>/exec';
// callAPI('GET', $url_api, $postData);
// $get_data = callAPI('GET', $url_api, $postData);
// $response = json_decode($get_data, true);
// if ($response['result'] == 'success' && is_int($response['row'])) {
//     wp_send_json_success();
// } else {
//     wp_send_json_error();
// }
