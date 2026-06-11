    <?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FieldController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\ExploreController;
use App\Http\Controllers\NoteController;

/*
|--------------------------------------------------------------------------
| Public Routes (Guest)
|--------------------------------------------------------------------------
*/


Route::get('/session-test', function () {
    session(['test' => 'working']);

    return response()->json([
        'session_id' => session()->getId(),
        'session_value' => session('test'),
    ]);
});




Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/about', function () {
    return view('about');
});

Route::get('/login', function () {
    return view('login');
})->name('login')->middleware('guest.custom');

Route::get('/register', function () {
    return view('register');
})->name('register')->middleware('guest.custom');

Route::get('/forget-password', function () {
    return view('forget-password');
})->name('forget-password')->middleware('guest.custom');

/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/

Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::post('/register/store', [RegisterUserController::class, 'store'])
    ->name('register.store');

Route::post('/check-email', [RegisterUserController::class, 'checkEmail'])
    ->name('check.email');

/*
|--------------------------------------------------------------------------
| Google Auth
|--------------------------------------------------------------------------
*/

Route::get('/auth/google', [GoogleAuthController::class, 'redirect'])
    ->name('google.login');

Route::get('/auth/google/callback', [GoogleAuthController::class, 'callback']);

/*
|--------------------------------------------------------------------------
| Protected Routes (Logged-in Users)
|--------------------------------------------------------------------------
*/

Route::middleware('auth.custom')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Upload Resource (Wizard)
    |--------------------------------------------------------------------------
    */
      Route::get('/upload-resource', [FieldController::class, 'index'])
        ->name('fields.upload');

    Route::post('/upload-resource', [FieldController::class, 'store'])
        ->name('fields.upload.store');

    /*
    |--------------------------------------------------------------------------
    | Explore Resources
    |--------------------------------------------------------------------------
    */

        Route::get('/resources/choose-type', [ResourceController::class, 'chooseType'])->name('resources.chooseType');
    Route::get('/explore', [ExploreController::class, 'index'])
        ->name('explore.resources');

    Route::get('/resources/select', [ResourceController::class, 'select'])
        ->name('resources.select');

    Route::post('/resources/choose-type', [ResourceController::class, 'chooseType'])
        ->name('resources.choose-type');

    Route::get('/resources/final', [ResourceController::class, 'showFinal'])
        ->name('resources.final');

    Route::get('/view-resources', [ResourceController::class, 'select'])
        ->name('resources.view');

    /*
    |--------------------------------------------------------------------------
    | Profile & Account
    |--------------------------------------------------------------------------
    */
    Route::get('/account/profile', [ProfileController::class, 'show'])
        ->name('account.profile');

    Route::post('/account/profile/update', [ProfileController::class, 'update'])
        ->name('account.profile.update');

    Route::post('/account/profile/password', [RegisterUserController::class, 'updatePassword'])
        ->name('account.profile.password');

    Route::get('/account/settings', [RegisterUserController::class, 'accountSettings'])
        ->name('account.settings');

    Route::post('/account/update-theme', [RegisterUserController::class, 'updateTheme'])
        ->name('account.update.theme');

    Route::post('/account/update-details', [RegisterUserController::class, 'updateDetails'])
        ->name('account.update.details');

    /*
    |--------------------------------------------------------------------------
    | My Documents
    |--------------------------------------------------------------------------
    */
    Route::get('/my-documents', [ProfileController::class, 'myDocuments'])
        ->name('my.documents');

    Route::delete('/my-documents/{id}', [ProfileController::class, 'deleteDocument'])
        ->name('documents.delete');

    Route::get('/documents/{id}/edit', [ProfileController::class, 'editDocument'])
        ->name('documents.edit');

    Route::put('/documents/{id}', [ProfileController::class, 'updateDocument'])
        ->name('documents.update');

    /*
    |--------------------------------------------------------------------------
    | Notes (Editor System)
    |--------------------------------------------------------------------------
    */
    Route::middleware('auth')->group(function () {
        Route::get('/notes', [NoteController::class, 'index'])
            ->name('notes.index');

        Route::get('/notes/create', [NoteController::class, 'create'])
            ->name('notes.create');

        Route::post('/notes', [NoteController::class, 'store'])
            ->name('notes.store');

        Route::get('/notes/{note}/edit', [NoteController::class, 'edit'])
            ->name('notes.edit');

        Route::put('/notes/{note}', [NoteController::class, 'update'])
            ->name('notes.update');
    });



    /*
    |--------------------------------------------------------------------------
    | Static Pages (Features / FAQ / Contact)
    |--------------------------------------------------------------------------
    */
    Route::get('/features', function () {
        return view('features.index');
    })->name('features');

    Route::get('/faq', function () {
        return view('features.faq');
    })->name('faq');

    Route::get('/contact', function () {
        return view('features.contact');
    })->name('contact');

});

