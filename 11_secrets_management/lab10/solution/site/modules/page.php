<?php

class Page {
    private $template;

    public function __construct(string $template) {
        $this->template = $template;
    }

    public function Render(array $data): string {
        $stderr = fopen('php://stderr', 'w');
        fwrite($stderr, print_r($data, true));
        $content = file_get_contents($this->template);
        foreach ($data as $key => $value) {
            $content = str_replace("{{ $key }}", $value, $content);
        }
        return $content;
    }
}
