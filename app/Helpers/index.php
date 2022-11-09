<?php

/*-- ----------- This is to show edit and delete button -----------  --*/
if(!function_exists('editDeleteBtn')) {
    function editDeleteBtn($btnName, $data):string {
        $dataAttr = htmlspecialchars(json_encode($data), ENT_QUOTES, 'UTF-8');
        return <<<HERE
            <div class="d-flex action-button">
                <button id="{$btnName}EditBtn" data-data="$dataAttr" class="btn btn-info btn-xs light px-2">
                    <i class="flaticon-162-edit"></i>
                </button>
                <button id="{$btnName}DeleteBtn" data-data="$dataAttr" class="ml-2 btn btn-xs px-2 light btn-danger">
                    <i class="flaticon-132-trash-1"></i>
                </button>
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
                <img src="$imgUrl" style="height: 50px"> <br>
                <a href="/dashboard/admin/view-activity/{$data['id']}" id="{$btnName}ViewActivityBtn" class="btn btn-link btn-xs light px-2" title="View Activity Schedules">
                    <i class="flaticon-057-eye"></i>
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
