<?php
namespace trepro\inspire\Controllers;

use Illuminate\Http\Request;
use trepro\Inspire\Inspire;

class InspirationController
{
    public function __invoke(Inspire $inspire) {
        $quote = $inspire->justDoIt();

        return $quote';
    }
}