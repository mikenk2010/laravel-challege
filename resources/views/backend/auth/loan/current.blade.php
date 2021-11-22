@extends('backend.layouts.app')

@section('title', __('Loan Management'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Current Loan')
        </x-slot>

        <x-slot name="body">
            Current Loan
        </x-slot>
    </x-backend.card>
@endsection
