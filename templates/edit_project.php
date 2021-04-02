<?php
class EditProject
{
    public static function render($index)
    {
        $html = <<<"EOT"
        <fieldset>
            <label for="project_name_$index">Project $index Name</label>
            <input type="text" name="project_name_$index" id="project_name_$index">
            <label for="project_description_$index">Project $index Description</label>
            <textarea name="project_description_$index" id="project_description_$index"></textarea>
        </fieldset>
    EOT;
        return $html;
    }
}
