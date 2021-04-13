<?php

function loadmodel($modelname){
    require_once(MODEL_PATH . "/{$modelname}.php");
}
function loadview($viewname, $params = array()){
    if (count($params) > 0) {
        foreach($params as $key => $value){
            if(strlen($key) > 0){
                ${$key} = $value;   
            }
        }
    }
    require_once(VIEW_PATH . "/{$viewname}.php");
}

function loadtemplateview($viewname, $params = array()){
    if (count($params) > 0) {
        foreach($params as $key => $value){
            if(strlen($key) > 0){
                ${$key} = $value;   
            }
        }
    }
    require_once(TEMPLATE_PATH . "/header.php");
    require_once(TEMPLATE_PATH . "/left.php");
    require_once(VIEW_PATH . "/{$viewname}.php");
    require_once(TEMPLATE_PATH . "/footer.php");
}

function rendertitle($title, $subtitle, $icon = null) {
    require_once(TEMPLATE_PATH . "/title.php");
}