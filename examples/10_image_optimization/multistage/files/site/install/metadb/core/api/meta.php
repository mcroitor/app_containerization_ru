<?php

namespace core\api;

interface meta {
    public function create(string $table, array $fields): string;
}