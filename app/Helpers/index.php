<?php

/*-- ----------- This is to show edit and delete button -----------  --*/
if(!function_exists('editDeleteBtn')) {
    function editDeleteBtn($btnName, $data):string {
        $dataAttr = htmlspecialchars(json_encode($data), ENT_QUOTES, 'UTF-8');

        if (isset($data->type))
        {
            $viewSchedules = <<< HERE
                <a href="/dashboard/admin/view-activity/{$data['id']}" id="{$btnName}ViewActivityBtn" class="ml-2 btn btn-xs px-2 light btn-success">
                    <i class="flaticon-057-eye"></i> View Schedules
                </a>
            HERE;
        } else {
            $viewSchedules = '';
        }

        return <<<HERE
            <div class="text-center action-button">
                <button id="{$btnName}EditBtn" data-data="$dataAttr" class="btn btn-info btn-xs light px-2">
                    <i class="flaticon-162-edit"></i>
                </button>
                <button id="{$btnName}DeleteBtn" data-data="$dataAttr" class="ml-2 btn btn-xs px-2 light btn-danger">
                    <i class="flaticon-132-trash-1"></i>
                </button>
                $viewSchedules
            </div>
        HERE;
    }
}

/*-- ----------- This is to show view activities button -----------  --*/
if(!function_exists('viewActivitiesBtn')) {
    function viewActivitiesBtn($btnName, $data):string {
        $imgUrl = asset('storage/' . $data['photo']);
        return <<<HERE
            <div class="action-button text-center">
                <a class="LGImg" href="$imgUrl" data-exthumbimage="$imgUrl" data-src="$imgUrl">
                    <img src="$imgUrl" style="height: 50px">
                </a>
            </div>
        HERE;
    }
}

/*-- ----------- PHP Array to HTML data attribute -----------  --*/
if(!function_exists('arrayToHTMLDataAttr')) {
    function arrayToHTMLDataAttr($data) {
        return htmlspecialchars(json_encode($data), ENT_QUOTES, 'UTF-8');
    }
}

/*-- ----------- SEMAPHORE SEND SMS API -----------  --*/
if (!function_exists('SPSendSMS')) {
    function SPSendSMS($recipient, $message) {
        $ch = curl_init();
        $parameters = [
            'apikey' => env('SEMAPHORE_API_KEY'),
            'number' => $recipient,
            'message' => $message,
            'sendername' => 'STRACKER'
        ];

        curl_setopt( $ch, CURLOPT_URL,'https://api.semaphore.co/api/v4/priority' );
        curl_setopt( $ch, CURLOPT_POST, 1 );

        //Send the parameters set above with the request
        curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $parameters ) );

        // Receive response from server
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        $output = curl_exec( $ch );
        curl_close ($ch);

        return $output;
    }
}
