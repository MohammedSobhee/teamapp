<?php
/**
 * Created by PhpStorm.
 * UserRequest: mohammedsobhei
 * Date: 5/12/17
 * Time: 2:50 PM
 */

function admin()
{
    if (auth()->guard('admin')->check()) {
        return auth()->guard('admin')->user();
    }

    return null;
}

function generateVerificationCode($digits = 6)
{
    $i = 0; //counter
    $pin = ""; //our default pin is blank.
    while ($i < $digits) {
        //generate a random number between 0 and 9.
        $pin .= mt_rand(0, 9);
        $i++;
    }
    return $pin;
}

function empObj()
{
    return new stdClass();
}

function modals($page)
{
    return 'admin.modals.' . $page;
}

function dashboard()
{
    return 'Dashboard';
}

function admin_vw()
{
    return 'admin';
}

function admin_home_url()
{
    return 'admin/home';
}

function admin_users_vw()
{
    return admin_vw() . '.users';
}

function admin_users_url()
{
    return admin_vw() . '/users';
}

function admin_groups_vw()
{
    return admin_vw() . '.groups';
}

function admin_groups_url()
{
    return admin_vw() . '/groups';
}

function admin_teams_vw()
{
    return admin_vw() . '.teams';
}

function admin_teams_url()
{
    return admin_vw() . '/teams';
}

function admin_leagues_vw()
{
    return admin_vw() . '.leagues';
}

function admin_leagues_url()
{
    return admin_vw() . '/leagues';
}

function admin_matches_vw()
{
    return admin_vw() . '.matches';
}

function admin_matches_url()
{
    return admin_vw() . '/matches';
}

function admin_pitches_vw()
{
    return admin_vw() . '.pitches';
}

function admin_pitches_url()
{
    return admin_vw() . '/pitches';
}

function admin_bookings_vw()
{
    return admin_vw() . '.bookings';
}

function admin_bookings_url()
{
    return admin_vw() . '/bookings';
}

function admin_transactions_vw()
{
    return admin_vw() . '.transactions';
}

function admin_transactions_url()
{
    return admin_vw() . '/transactions';
}

function admin_positions_vw()
{
    return admin_vw() . '.positions';
}

function admin_positions_url()
{
    return admin_vw() . '/positions';
}

function admin_stats_vw()
{
    return admin_vw() . '.stats';
}

function admin_stats_url()
{
    return admin_vw() . '/stats';
}

function admin_results_vw()
{
    return admin_vw() . '.results';
}

function admin_results_url()
{
    return admin_vw() . '/results';
}

function admin_articles_vw()
{
    return admin_vw() . '.articles';
}

function admin_articles_url()
{
    return admin_vw() . '/articles';
}

function admin_settings_url()
{
    return admin_vw() . '/settings';
}

function version_api()
{
    return '/v1';
}

function namespace_api()
{
    return 'Api\V1';
}

function google_api_key()
{
    return 'AIzaSyDviHB7G4RWAgQNwvjaVXLhC1j5DNTSPFE';
}

function public_url()
{
    return url('public/');
}

function upload_url()
{
    return base_path() . '/assets/upload';
}

function upload_assets()
{
    return url('/assets/upload');
}

function upload_storage()
{
    return storage_path('app');
}

function loader_icon()
{
    return url('assets/admin/layout/img/preloader.gif');
}

function user_vw()
{
    return 'user';
}

function max_pagination($record = 10.0)
{
    return $record;
}

function admin_layout_vw()
{
    return 'admin.layout';
}

function admin_assets_vw()
{
    return 'assets/admin';
}

function notification_trans()
{
    return 'app.notification_message';
}


function message($status_code)
{
    switch ($status_code) {
        case 200:
            return trans('app.success');
        case 400:
            return trans('app.not_data_found');
        case 401:
            return trans('app.invalid_token');
        case 404:
            return trans('app.invalid_route');
        case 422:
            return trans('app.client_input_error');//'Client input error.';
        case 500:
            return trans('app.server_error');//'Something went wrong. Please try again later.';
    }
    return 'Sorry! You do not have permission.';
}

function getClientId()
{
    return 2;
}

function getClientSecret()
{
    return 'gsOl6azFiGgMNOGadmE8aIrYAH8U2Mv3yYmMt7Ue';
}

function page_count($num_object, $page_size)
{
    return ceil($num_object / (doubleval($page_size)));
}

function response_api($status, $statusCode, $message = null, $object = null, $page_count = null, $page = null, $count = null, $errors = null, $another_data = null)
{

    $message = isset($message) ? $message : message($statusCode);
    $error = ['status' => false, 'statusCode' => $statusCode, 'message' => $message];
    $success = ['status' => true, 'statusCode' => $statusCode, 'message' => $message];

    if ($status && isset($object)) {
        if (isset($page_count) && isset($page))
            $success['items'] = ['data' => $object, 'total_pages' => $page_count, 'current_page' => $page + 1, 'total_records' => $count];
        else
            $success['items'] = $object;

    } else if (!$status && isset($errors))
        $error['errors'] = $errors;
    else if (isset($object) || (is_array($object) && empty($object)))
        $error['items'] = $object;

    if (isset($another_data))
        foreach ($another_data as $key => $value)
            $success [$key] = $value;
    $response = ($status) ? $success : $error;
    return response()->json($response);
}

function distance($point1_lat, $point1_long, $point2_lat, $point2_long, $unit = 'K', $decimals = 2)
{
    // Calculate the distance in degrees
    $degrees = rad2deg(acos((sin(deg2rad($point1_lat)) * sin(deg2rad($point2_lat))) + (cos(deg2rad($point1_lat)) * cos(deg2rad($point2_lat)) * cos(deg2rad($point1_long - $point2_long)))));

    // Convert the distance in degrees to the chosen unit (kilometres, miles or nautical miles)
    switch ($unit) {
        case 'K':
            $distance = $degrees * 111.13384; // 1 degree = 111.13384 km, based on the average diameter of the Earth (12,735 km)
            break;
        case 'mi':
            $distance = $degrees * 69.05482; // 1 degree = 69.05482 miles, based on the average diameter of the Earth (7,913.1 miles)
            break;
        case 'nmi':
            $distance = $degrees * 59.97662; // 1 degree = 59.97662 nautic miles, based on the average diameter of the Earth (6,876.3 nautical miles)
    }
    return round($distance, $decimals);
}

function send_sms($mobile, $text)

{

//    $messgmobile = urlencode($text);
//
//    $url = "http://www.nst-sms.com/api.php?send_sms&username=966540400008&password=12345&numbers=" . $mobile . "&sender=LOGISTX&message=" . $messgmobile;
//
//    $ch = curl_init();
//
//    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//
//    curl_setopt($ch, CURLOPT_URL, $url);

    // return curl_exec($ch);
    return true;

}


function Log2($x)
{
    return (log10($x) /
        log10(2));
}


// Function to check
// if x is power of 2
function isPowerOfTwo($n)
{
    return (ceil(Log2($n)) ==
        floor(Log2($n)));
}
