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
