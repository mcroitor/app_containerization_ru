<?php

class Page {
    private $template;

    public function __construct(string $template) {
        $this->template = $template;
    }

    public function Render(array $data): string {
        $content = file_get_contents($this->template);
        foreach ($data as $key => $value) {
            $content = str_replace("{{ $key }}", $value, $content);
        }
        return $content;
    }
}
