<?php

namespace core;

class meta_structure implements \core\api\meta
{


    public function create(string $table_name, array $table_columns): string
    {
        $data = "<?php" . PHP_EOL . PHP_EOL;
        $data .= "namespace meta;" . PHP_EOL . PHP_EOL;

        $data .= "class {$table_name} {" . PHP_EOL . PHP_EOL;
        $data .= "/** table name constant */" . PHP_EOL;
        $data .= "\tpublic const __name__ = '$table_name';" . PHP_EOL . PHP_EOL;
        $data .= "/** table columns constants */" . PHP_EOL;
        foreach ($table_columns as $column) {
            if (!is_integer($column)) {
                $data .= "\tpublic const {$column} = '{$column}';" . PHP_EOL;
            }
        }
        $data .= "}" . PHP_EOL;

        return $data;
    }
}
