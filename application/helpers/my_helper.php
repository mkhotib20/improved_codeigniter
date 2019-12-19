<?php
function loadCss(Array $css)
{
    foreach ($css as $key => $value) {
        $arr[] = '<link rel="stylesheet" href="'.base_url().$value.'"> ';
    }
    return implode('', $arr);
}
function loadJs(Array $js)
{
    foreach ($js as $key => $value) {
        $arr[] = '<script src="'.base_url().$value.'"></script>';
    }
    return implode('', $arr);
}
function dd($data)
{
    echo "<pre style='color: red; margin: 30px; background-color: #dbdbdb; padding: 20px'>";
    print_r($data);
    echo "</pre>";
    exit;
}
function textField($model, $options = []){
    return form_input($options);
}

?>