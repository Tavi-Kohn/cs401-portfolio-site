<?php
class LogoutButton
{
    public static function render()
    {
        $html = <<<"EOT"
    <a class="button" href="/logout">Log Out</a>
    EOT;
        return $html;
    }
}
