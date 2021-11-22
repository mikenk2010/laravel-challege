@extends('backend.layouts.app')

@section('title', __('Loan Management'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Loan Management')
        </x-slot>

        <x-slot name="body">
            <livewire:loans-table/>
        </x-slot>
    </x-backend.card>
@endsection
