<?php
include_once __DIR__ . "/config.php";

function create_meta_info($dboptions, $output_dir)
{
    $generator = new \core\generator($dboptions);
    $generator->set_output_dir($output_dir);

    if (!file_exists($generator->get_output_dir())) {
        if (!mkdir($generator->get_output_dir())) {
            return "cant create directory {$generator->get_output_dir()}";
        }
    }

    $generator->do(new core\meta_class());
    return "done.";
}
