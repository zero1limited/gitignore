<?php
$isDebug = isset($argv[1]) && $argv[1] == 'DEBUG';
function debug($message){
    global $isDebug;
    if($isDebug){
        echo $message.PHP_EOL;
    }
}
$start = '# Zero1 Start';
$end = '# Zero1 End';
$template = file_get_contents('https://raw.githubusercontent.com/zero1limited/gitignore/master/template');
if(!$template){
    echo 'template empty';
    return;
}
$template = $start.PHP_EOL.$template.PHP_EOL.$end;
debug('template: '.$template);
$gitIgnore = is_file('.gitignore')? file_get_contents('.gitignore') : '';

$r = preg_match('/'.$start.'.*'.$end.'/s', $gitIgnore, $matches);
debug('r: '.json_encode($r));
debug(print_r($matches, true));

if($r === 1){
    $gitIgnore = str_replace($matches[0], $template, $gitIgnore);
}elseif ($r === 0) {
    $gitIgnore .= PHP_EOL.$template;
}
file_put_contents('.gitignore', $gitIgnore);
