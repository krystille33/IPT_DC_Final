@extends('layouts.admin')
@section('content')
<livewire:orders.index>
@endsection
@section('script')

<script>
    window.addEventListener('close-modal', event => {
        $('#orderModal').modal('hide');
        $('#updateorderModal').modal('hide');
        $('#deleteorderModal').modal('hide');
    });
    </script>
@endsection

