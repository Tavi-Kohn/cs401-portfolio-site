<?php
class LoginButton
{
    public static function render()
    {
        $html = <<<"EOT"
    <a class="button" href="/login">Log In</a>
    EOT;
        return $html;
    }
}
