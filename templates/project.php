<?php
class Project
{
    public static function render($name, $description, $image)
    {
        $html = <<<"EOT"
    <section class="project">
    <h1>$name</h1>
    <img src="$image" />
    <p class="description">$description</p>
    </section>
    EOT;
        return $html;
    }
}
