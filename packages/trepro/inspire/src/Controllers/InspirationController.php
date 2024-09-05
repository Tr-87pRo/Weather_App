<?php
namespace trepro\Inspire\Controllers;

use Illuminate\Http\Request;
use trepro\Inspire\Inspire;

class InspirationController
{
    public function __invoke() {
        $inspire = new Inspire;
        $quote = $inspire->justDoIt();

        return view('inspire::index', compact('quote'));
    }
}