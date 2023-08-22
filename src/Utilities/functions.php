<?php

use Illuminate\Support\Facades\Hash;

if (!function_exists('hash_answer')) {
    function hash_answer($answer): string
    {
        $strict = config("questions.strict", false);
        if ($strict) {
            return Hash::make($answer);
        }

        $cleaned = preg_replace('/[^a-zA-Z0-9]/', '', $answer);
        $cleaned = strtoupper($cleaned);
        return Hash::make($cleaned);
    }
}

if (!function_exists('match_answer')) {
    function match_answer($answer, $hash): bool
    {
        $strict = config("questions.strict", false);
        if (!$strict) {
            $answer = preg_replace('/[^a-zA-Z0-9]/', '', $answer);
            $answer = strtoupper($answer);
        }

        return Hash::check($answer, $hash);
    }
}
