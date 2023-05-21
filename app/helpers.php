<?php

if (!function_exists('mb_substr_replace')) {
    /**
     * subst_replace function with UTF-8 support
     *
     * @param $original
     * @param $replacement
     * @param $position
     * @param $length
     * @return string
     */
    function mb_substr_replace($original, $replacement, $position, $length): string
    {
        $startString = mb_substr($original, 0, $position, 'UTF-8');
        $endString = mb_substr($original, $position + $length, mb_strlen($original), 'UTF-8');
        return $startString . $replacement . $endString;
    }
}
