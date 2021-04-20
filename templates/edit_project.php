<?php
class EditProject
{
    public static function render(int $index, String $name = "", String $description = "")
    {
        $html = <<<"EOT"
        <fieldset>
            <label for="project_name_$index">Project $index Name</label>
            <input type="text" name="project_name_$index" id="project_name_$index" value="$name">
            <label for="project_description_$index">Project $index Description</label>
            <textarea name="project_description_$index" id="project_description_$index">$description</textarea>
        </fieldset>
    EOT;
        return $html;
    }
}
