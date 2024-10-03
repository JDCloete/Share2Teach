//
//
//use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\Route;
//
//// Login route
//Route::post('/login', function (Request $request) {
//    $request->validate([
//    'email' => 'required|email',
//    'password' => 'required',
//    ]);
//
//    if (Auth::attempt($request->only('email', 'password'))) {
//        // Create token for the authenticated user
//        return response()->json(['token' => $request->user()->createToken('YourAppName')->plainTextToken]);
//    }
//
//        return response()->json(['message' => 'Unauthorized'], 401);
//});
//
//// Logout route
//Route::post('/logout', function (Request $request) {
//    $request->user()->currentAccessToken()->delete();
//
//    return response()->json(['message' => 'Logged out']);
//});
//
//
//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');
//
//
//// Protected route example
//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
//
//
//
//
