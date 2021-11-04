<?php
$password = '123';
$hash = password_hash($password, PASSWORD_DEFAULT);

// $hash = '$2y$07$BCryptRequires22Chrcte/VlQH0piJtjXl.0t1XkA8pw9dMXTpOq';

echo $password . " / " . gettype([$password]) . " // " . $hash . " / " . gettype([$hash]) . "<br>  ";
echo strlen($hash);


if (password_verify($password, $hash)) {
    echo '패스워드 맞음';
} else {
    echo '패스워드 맞지 않음';
}