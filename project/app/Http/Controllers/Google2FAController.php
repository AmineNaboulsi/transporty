<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use PragmaRX\Google2FA\Google2FA;
use Illuminate\Support\Facades\Auth;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;

class Google2FAController extends Controller
{
    private $google2fa;

    public function __construct()
    {
        $this->google2fa = new Google2FA();
    }

    public function setup()
    {
        $user = User::find(Auth::id());

        if (empty($user->google2fa_secret)) {
            $user->google2fa_secret = $this->google2fa->generateSecretKey();
            $user->save();
        }

        $qrCodeUrl = $this->google2fa->getQRCodeUrl(
            config('app.name'),
            $user->email,
            $user->google2fa_secret
        );

        $renderer = new ImageRenderer(
            new RendererStyle(200),
            new SvgImageBackEnd()
        );

        $writer = new Writer($renderer);
        $qrcode_image = $writer->writeString($qrCodeUrl);

        return view('2fa.setup', [
            'secret' => $user->google2fa_secret,
            'qrcode' => $qrcode_image
        ]);
    }

    public function verify()
    {
        return view('2fa.verify');
    }

    public function authenticate(Request $request)
    {
        $user = User::find(Auth::id());

        $valid = $this->google2fa->verifyKey(
            $user->google2fa_secret,
            $request->input('one_time_password')
        );

        if ($valid) {
            $user->google2fa_enabled = true;
            $user->save();
            return redirect()->back();
        }

        return back()->withErrors(['one_time_password' => 'Invalid authentication code']);
    }

    public function disable(Request $request)
    {
        $user = User::find(Auth::id());
        $user->google2fa_secret = null;
        $user->save();

        $request->session()->forget('2fa_verified');

        return redirect()->route('profile')->with('success', '2FA has been disabled');
    }
}
