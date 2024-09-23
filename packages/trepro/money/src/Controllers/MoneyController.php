<?php

namespace trepro\Money\Controllers;

use Illuminate\Http\Request;
use trepro\Money\MoneyService;

class MoneyController extends Controller
{
    private $moneyService;

    public function __construct(MoneyService $moneyService)
    {
        $this->moneyService = $moneyService;
    }

    public function index(Request $request)
    {
        // Controller logic for money module
    }
}