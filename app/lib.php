<?

function makeReqURL ($path, $args = []) {
    $out = $path;

    if ($args) {
        $out .= '?';
        foreach($args as $arg) {
            $out .= $arg . '&';
        }
    }
    return substr($out, 0, -1);
}
