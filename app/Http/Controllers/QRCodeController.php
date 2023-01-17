<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Imagick;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use TarfinLabs\ZbarPhp\Exceptions\ZbarError;
use TarfinLabs\ZbarPhp\Zbar;

class QRCodeController extends Controller
{
    public function index()
    {
        return view('listFunction');
    }

    public function enterQRCode()
    {
        return view('enterQRCode');
    }

    public function renderQRCode(Request $request)
    {
        if ($request->has('qrCode')) {
            $qrData = base64_encode(QrCode::format('png')->size(100)->generate($request->get('qrCode')));
            return view('myQRCode', [
                'qrData' => $qrData,
            ]);
        } else {
            return redirect()->route('enterQRCode');
        }
    }

    public function downloadQRCode(Request $request)
    {
        if ($request->has('qrData')) {
            $pdf = Pdf::loadView('qrCodePdf', [
                'qrData' => $request->get('qrData'),
            ]);

            $name = 'qrCode.pdf';
            return $pdf->download($name);
        } else {
            return redirect()->route('enterQRCode');
        }
    }

    public function readQRCode(Request $request)
    {
        $cropedQRPath    = 'public/' . Str::random(40) . '.png';
        $filePath        = 'public/qrCode.pdf';
        $imagickInstance = $this->cropQrCodeFromPDF($filePath);

        Storage::put($cropedQRPath, $imagickInstance->getImageBlob());

        try {
            $readedCode = (new Zbar(Storage::path($cropedQRPath)))->scan();
            return view('readQRCodeResponse', [
                'code' => $readedCode,
            ]);
        } catch (ZbarError) {
            $readedCode = null;
        }

        Storage::delete($cropedQRPath);

        return $readedCode;
    }

    /**
     * @throws \Exception
     */
    public function cropQrCodeFromPDF(string $filePath): Imagick
    {
        $imagick = new Imagick();
        $imagick->setResolution(128, 128);
        $imagick->readImageBlob(Storage::get($filePath));
        $imagick->setImageFormat('png');

        return $imagick;
    }
}
