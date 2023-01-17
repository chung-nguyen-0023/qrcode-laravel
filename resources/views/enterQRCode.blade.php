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
