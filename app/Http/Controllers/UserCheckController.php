<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FreeTrialUser;

class UserCheckController extends Controller
{
    public function checkField(Request $request)
    {
        $field = $request->only(['email', 'domain']);
        $exists = FreeTrialUser::where($field)->exists();

        return response()->json(['exists' => $exists]);
    }
}
