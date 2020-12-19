<?php
namespace App\Services;

use Illuminate\Foundation\Validation\ValidatesRequests;
class Service {
    use ValidatesRequests;

    public static function make() {
        return new static();
    }
}