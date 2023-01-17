- [Lời mở đầu](#lời-mở-đầu)
- [QRCode là gì](#qrcode-là-gì)
- [QR Code khác gì với mã vạch truyền thống?](#qr-code-khác-gì-với-mã-vạch-truyền-thống)
  - [Tính thẩm mỹ](#tính-thẩm-mỹ)
- [Tích hợp QR Code vào dự án Laravel](#tích-hợp-qr-code-vào-dự-án-laravel)
  - [Cài đặt Laravel](#cài-đặt-laravel)
  - [Cài đặt Homebrew](#cài-đặt-homebrew)
  - [Cài đặt Zbar](#cài-đặt-zbar)
  - [Cài đặt Image Magick](#cài-đặt-image-magick)
  - [Tạo file .env](#tạo-file-env)
  - [Triển khai Code](#triển-khai-code)
- [Kết luận](#kết-luận)

# Lời mở đầu
Ngày nay chúng ta không còn xa lạ gì về QR Code cũng như các ứng dụng của nó trong cuộc sống. Qua bài viết này chúng ta sẽ tìm hiểu qua một chút thông tin về QR Code cũng như áp dụng mã QR Code vào dự án Laravel.

# QRCode là gì
QR Code (mã QR) là viết tắt của Quick response code (Tạm dịch: Mã phản hồi nhanh), hoặc có thể gọi là Mã vạch ma trận (Matrix-barcode) hay Mã vạch 2 chiều (2D). Đây là một dạng thông tin được mã hóa để hiển thị sao cho máy có thể đọc được.

QR Code xuất hiện lần đầu tiên vào năm 1994, được tạo ra bởi Denso Wave (công ty con của Toyota). QR Code bao gồm những chấm đen và ô vuông mẫu trên nền trắng, có thể chứa những thông tin như URL, thời gian, địa điểm của sự kiện, mô tả, giới thiệu một sản phẩm nào đó,...

QR Code cho phép quét và đọc mã nhanh hơn bằng các thiết bị như máy đọc mã vạch hoặc điện thoại có camera với ứng dụng cho phép quét mã, vô cùng tiện lợi cho người dùng.

# QR Code khác gì với mã vạch truyền thống?
Cùng là mã vạch nhưng QR Code lại là phiên bản cải tiến của mã vạch truyền thống. Mã vạch truyền thống là một dãy các vạch được xếp liền kề nhau, chỉ chứa được tối đa `20 ký tự số`, trong khi đó thì mã QR có khả năng chứa tối đa `7.089 ký tự số` và `4.296 ký tự chữ số`.

Điều này cho phép lượng thông tin truyền tải sẽ nhiều hơn, hỗ trợ tốt hơn cho người dùng, đặc biệt là những doanh nghiệp kinh doanh muốn gửi thông điệp đến khách hàng của mình.

## Tính thẩm mỹ
Không chỉ thế, nếu so về kích thước thì QR Code chiếm ít không gian hơn rất nhiều so với mã vạch truyền thống. Nếu in trên sản phẩm hoặc danh thiếp thì sẽ nhỏ gọn và tăng tính thẩm mỹ hơn.

![tinh-tham-my](./image_document/1-tinh-tham-my.jpeg)

# Tích hợp QR Code vào dự án Laravel
## Cài đặt Laravel
Để cài đặt dự án laravel ta chạy command sau:
```
git clone https://github.com/laravel/laravel qr-laravel
```

Tiếp theo chúng ta sẽ cài đặt thư viện `simplesoftwareio/simple-qrcode`:
```
composer require simplesoftwareio/simple-qrcode
```

Sau đó chúng ta cài đặt thư viện `tarfin-labs/zbar-php`. Để cài đặt thư viện `tarfin-labs/zbar-php`, chúng ta cần cài đặt [zbar](http://zbar.sourceforge.net/) và [imagemagick](https://imagemagick.org/) trước:

## Cài đặt Homebrew
Để cài đặt `Zbar` hoặc `Image Magick` trên hệ điều hành MacOS các bạn cần cài đặt `Homebrew`, để cài đặt `Homebrew` các bạn làm theo các bước sau:
1. Nhấn `Command+Space` và gõ `Terminal` sau đó nhấn phím `enter/return`.
2. Copy đoạn lệnh sau vào Terminal `/bin/bash -c "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/HEAD/install.sh)"`, sau đó nhấn phím `enter/return`. Đợi lệnh kết thúc. Nếu bạn được nhắc nhập mật khẩu thì nhập mật khẩu đăng nhập người dùng máy Mac xong nhấn phím `enter/return`. Vì lý do bảo mật nên mật khẩu sẽ không hiển thị lên `Terminal`.
3. Copy đoạn lệnh sau `echo 'eval "$(/opt/homebrew/bin/brew shellenv)"' >> ~/.zprofile` và nhấn phím `enter/return`.

## Cài đặt Zbar
Sau khi cài đặt `Homebrew` thì các bạn chạy câu lệnh sau để cài đặt `Zbar`:
```
brew install zbar
```

## Cài đặt Image Magick
Trước khi cài đặt `Image Magick`, các bạn cần cài đặt `php` version `8.1` vì thời điểm viết bài này version `8.2` chưa hỗ trợ `Image Magick`. Để cài đặt `php8.1` chúng ta làm như sau:
```
brew update
brew upgrade php
brew tap shivammathur/php
brew install shivammathur/php/php@8.1
php -v
```


Tiếp đó chúng ta sẽ cài đặt Image Magick:
```
brew install pkg-config imagemagick
brew install ghostscript
pecl install imagick
brew services restart php
```

Sau đó chúng ta cài đặt các thư viện còn lại:
```
composer require tarfin-labs/zbar-php
```

## Tạo file .env
Để ứng dụng Laravel có thể hoạt động, chúng ta phải tạo file `.env` ở thư mục gốc của dự án và copy nội dung của file `.env.example` sang file `.env`.

Tiếp theo chúng ta sẽ tạo key mã hoá cho dự án bằng cách chạy câu lệnh:
```
php artisan key:generate
```

## Triển khai Code
Sau khi hoàn thành phần cài đặt, chúng ta vào file `routes/web.php` tạo Route `/`.
```php
<?php
// routes/web.php

use App\Http\Controllers\QRCodeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [QRCodeController::class, 'index'])->name('index');
```

Tiếp đó chúng ta tạo controller `QRCodeController` qua câu lệnh:
```
php artisan make:controller QRCodeController
```

Tiếp theo chúng ta sẽ viết code cho method `index` trong `QRCodeController`:
```php
<?php
// app/Http/Controllers/QRCodeController.php
namespace App\Http\Controllers;

class QRCodeController extends Controller
{
    public function index()
    {
        return view('listFunction');
    }
}
```

Method `index` hiển thị view `listFunction`. View `listFunction` sẽ có 2 button chức năng cho user lựa chọn:
```php
// resources/views/listFunction.blade.php
@extends('layout')

@section('content')
<a href="{{ route('enterQRCode') }}" class="btn btn-primary">Tạo QR Code</a>
<a href="{{ route('readQRCode') }}" class="btn btn-secondary">Đọc QR Code</a>
@stop
```

Ta thấy file view `listFunction` có `extends` file `layout`, file `layout` là file khung giao diện của dự án:
```php
// resources/views/layout.blade.php
<html>
    <head>
        <title>QR Code</title>
        <meta charset="utf-8">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    </head>
    <style>
        .main-wrapper {
            max-width: 800px;
            margin: 50px auto;
            text-align: center;
        }
    </style>
    <body>
        <div class="main-wrapper">
            @yield('content')
        </div>
    </body>
</html>
```

Giờ chúng ta sẽ xây dựng chức năng `Tạo QR Code`, chúng ta sẽ đăng ký route mới cho chức năng này:
```php
// routes/web.php

...
Route::get('/enterQRCode', [QRCodeController::class, 'enterQRCode'])->name('enterQRCode');
``` 

Tiếp đó chúng ta sẽ viết code cho chức năng `enterQRCode`:
```php
<?php
// app/Http/Controllers/QRCodeController.php
namespace App\Http\Controllers;

class QRCodeController extends Controller
{
    public function enterQRCode()
    {
        return view('enterQRCode');
    }
}
```

Ở method `enterQRCode` chúng ta render view `enterQRCode`. View `enterQRCode` có nhiệm vụ cho phép người dùng nhập text bất kỳ và có 1 nút button để render text đó thành mã QRCode.
```php
// resources/views/enterQRCode.blade.php
@extends('layout')

@section('content')
<form action="{{ route('renderQRCode') }}" method="get">
    @csrf
    <div class="mb-3">
        <input type="text" class="form-control" name="qrCode" required placeholder="Vui lòng nhập ký tự bạn muốn tạo QR Code">
    </div>
    <button type="submit" class="btn btn-primary">Tạo QR Code</button>
</form>
@stop
```

Như chúng ta đã thấy view `enterQRCode` có 1 form gọi đến route `renderQRCode` nên chúng ta sẽ đi xây dựng tính năng `renderQRCode` này:
```php
<?php
// routes/web.php
use App\Http\Controllers\QRCodeController;
use Illuminate\Support\Facades\Route;

...
Route::get('/renderQRCode', [QRCodeController::class, 'renderQRCode'])->name('renderQRCode');
```

Method `renderQRCode` trong `QRCodeController` sẽ trông thế này:
```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QRCodeController extends Controller
{
    ...
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
}
```

Method `renderQRCode` sẽ nhận giá trị của người dùng khi nhập vào và sẽ dùng package `QrCode` để tạo mã qrCode và lưu vào biến `$qrData`. Cuối cùng là hiển thị mã qrCode đó ra view `myQRCode`:
```php
// resources/views/myQRCode.blade.php
@extends('layout')

@section('content')
<form action="{{ route('downloadQRCode') }}" method="get">
    @csrf
    <div class="mb-3">
        <img src="data:image/png;base64, {!! $qrData !!} ">
    </div>

    <input name="qrData" type="hidden" value="{{ $qrData }}">
    <button type="submit" class="btn btn-primary">Download QR Code</button>
</form>
@stop
```

Và ở view `myQRCode`, chúng ta có thêm tính năng `downloadQRCode` dưới dạng pdf để tiện sử dụng về sau, tính năng `downloadQRCode` được viết như sau:
```php
<?php
// app/Http/Controllers/QRCodeController.php
namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class QRCodeController extends Controller
{
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
}
```

Sau khi download file qrCode, để truy xuất nội dung bên trong file thì chúng ta cần xây dựng tính năng `readQRCode`. Chúng ta sẽ khai báo route cho tính năng này:
```php
<?php
// routes/web.php
use App\Http\Controllers\QRCodeController;
use Illuminate\Support\Facades\Route;

...
Route::get('/readQRCode', [QRCodeController::class, 'readQRCode'])->name('readQRCode');
```

Và tiếp đến sẽ viết code xử lý bên trong `QRCodeController`:
```php
<?php
// app/Http/Controllers/QRCodeController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Imagick;
use TarfinLabs\ZbarPhp\Exceptions\ZbarError;
use TarfinLabs\ZbarPhp\Zbar;

class QRCodeController extends Controller
{
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
```

Sau đó chúng ta sẽ copy file pdf vào folder `storage/app/public` rồi truy cập đường dẫn `http://localhost:8000/readQRCode` để nhìn thấy nội dung của file qrCode.

# Kết luận
Qua bài viết này chúng ta đã biết qua cách tích hợp QRCode vào dự án Laravel. Mình hy vọng nó ít, nhiều sẽ giúp ích được các bạn trong công việc. Cảm ơn các bạn đã đọc và theo dõi. Các bạn có thể tải source code [ở đây](https://github.com/chung-nguyen-0023/qrcode-laravel) để tìm hiểu thêm.
