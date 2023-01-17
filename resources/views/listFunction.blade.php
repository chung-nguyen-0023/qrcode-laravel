@extends('layout')

@section('content')
<a href="{{ route('enterQRCode') }}" class="btn btn-primary">Tạo QR Code</a>
<a href="{{ route('readQRCode') }}" class="btn btn-secondary">Đọc QR Code</a>
@stop
