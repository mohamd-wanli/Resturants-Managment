<?php

namespace App\Http\Controllers;

use App\Mail\VerificationCode;
use App\Models\Table;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Mail;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function download($id)
    {
        $table = Table::find($id);

        return response()->file(public_path($table->Qr_code_path));

    }

    public function test()
    {

        try {
            Mail::to('mr.amerkb@gmail.com')->send(new VerificationCode(111));
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        return 1;
    }
}
