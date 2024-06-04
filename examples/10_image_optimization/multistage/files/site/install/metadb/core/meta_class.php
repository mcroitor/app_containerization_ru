<?php

namespace core;

class meta_class implements \core\api\meta
{

    public function create(string $table_name, array $table_columns): string
    {
        $data = "<?php" . PHP_EOL . PHP_EOL;
        $data .= "namespace meta;" . PHP_EOL . PHP_EOL;

        $data .= "class {$table_name} {" . PHP_EOL . PHP_EOL;
        $data .= "/** table name constant */" . PHP_EOL;
        $data .= "\tpublic const __name__ = '$table_name';" . PHP_EOL . PHP_EOL;
        $data .= $this->column_fields($table_columns);
        $data .= $this->column_names($table_columns);
        $data .= $this->constructor();

        $data .= "}" . PHP_EOL;

        return $data;
    }

    private function column_fields(array $table_columns): string
    {
        $data = "/** table columns fields */" . PHP_EOL;
        foreach ($table_columns as $column) {
            if (!is_integer($column)) {
                $data .= "\tpublic \${$column};" . PHP_EOL;
            }
        }
        return $data;
    }

    private function column_names(array $table_columns): string
    {
        $data = PHP_EOL . "/** table columns names */" . PHP_EOL;
        foreach ($table_columns as $column) {
            if (!is_integer($column)) {
                $UP = strtoupper($column);
                $data .= "\tpublic const {$UP} = '{$column}';" . PHP_EOL;
            }
        }
        return $data;
    }

    private function constructor(): string
    {
        $data = PHP_EOL . "/** constructor */" . PHP_EOL;
        $data .= "\tpublic function __construct(array|object \$data) {" . PHP_EOL;
        $data .= "\t\tforeach(\$data as \$key => \$value) {" . PHP_EOL;
        $data .= "\t\t\t\$this->\$key = \$value;" . PHP_EOL;
        $data .= "\t\t}" . PHP_EOL;
        $data .= "\t}" . PHP_EOL;
        return $data;
    }
}
