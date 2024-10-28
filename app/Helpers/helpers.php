<?php

if (!function_exists('getStatusIcon')) {
    function getStatusIcon($status)
    {
        switch ($status) {
            case 'proses':
                return 'fa-spinner fa-spin';
            case 'acc':
                return 'fa-check';
            case 'late':
                return 'fa-exclamation';
            default:
                return 'fa-question';
        }
    }
}