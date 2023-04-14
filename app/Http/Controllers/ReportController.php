<?php

namespace App\Http\Controllers;

use App\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function reportMessage(Request $request, $id)
    {
        $report = new Report();
        $report->user_id = $request->user()->id;
        $report->message_id = $id;
        $report->save();

        return response()->json(['message' => __('- MESSAGE BLOCKED -')], 200);
    }
}
