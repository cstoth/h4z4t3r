<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use App\Repositories\Frontend\Auth\UserRepository;
use App\Http\Requests\Frontend\User\UpdateProfileRequest;
use App\Http\Requests\Frontend\User\DeleteProfileRequest;
use App\Models\Advertise;
use App\Models\Reserve;
use Illuminate\Support\Facades\DB;
use App\Models\Auth\User;
use App\Models\Rate;

/**
 * Class ProfileController.
 */
class ProfileController extends Controller {
    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * ProfileController constructor.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    /**
     * @param UpdateProfileRequest $request
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function update(UpdateProfileRequest $request) {
        $output = $this->userRepository->update(
            $request->user()->id,
            $request->only('first_name', 'last_name', 'email', 'avatar_type', 'avatar_location', 'phone'),
            $request->has('avatar_location') ? $request->file('avatar_location') : false
        );

        // E-mail address was updated, user has to reconfirm
        if (is_array($output) && $output['email_changed']) {
            auth()->logout();

            return redirect()->route('frontend.auth.login')->withFlashInfo(__('strings.frontend.user.email_changed_notice'));
        }

        return redirect()->route('frontend.user.account')->withFlashSuccess(__('strings.frontend.user.profile_updated'));
    }

    /**
     *
     */
    public function delete(DeleteProfileRequest $request) {
        $user = $request->user();
        $cnt = Advertise::where('status', Advertise::ACTIVE)->whereNull('template')->where('user_id', $user->id)->count();
        if ($cnt > 0) {
            return redirect()->route('frontend.user.account')->withFlashDanger('Profilja nem törölhető, mert van aktív hirdetése!');
        }
        //$cnt = Reserve::where('status', Reserve::ACTIVE)->where('user_id', $user->id)->count();
        $cnt = Reserve::where('user_id', $user->id)->count();
        if ($cnt > 0) {
            return redirect()->route('frontend.user.account')->withFlashDanger('Profilja nem törölhető, mert van aktív foglalása!');
        }

        $user->delete();
        DB::delete('delete from users where deleted_at is not null');
        DB::delete('delete from social_accounts where user_id not in (select id from users)');
        auth()->logout();
        return redirect()->route('frontend.index')->withFlashInfo('Profilja sikeresen törölve!');
    }

    /**
     *
     */
    public function show($id) {
        //\Log::info($id);
        $user = User::find($id);
        \Log::info($user);
        return view('frontend.user.account.show')->withUser($user);
    }

    /**
     *
     */
    public function rate($id) {
        //\Log::info($id);
        $user = User::find($id);
        $rates = Rate::where('user_id', $id)->orderBy('created_at')->get();
        return view('frontend.user.account.rate')->withUser($user)->withRates($rates);
    }
}
