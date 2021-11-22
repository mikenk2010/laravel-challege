@extends('backend.layouts.app')

@section('title', __('Approve Loan'))

@section('content')

<x-forms.patch :action="route('admin.auth.loan.update', $loan)">
    <x-backend.card>
        <x-slot name="header">
            @lang('Approve Loan')
        </x-slot>

        <x-slot name="body">

            <input type="hidden" name="loan_id" class="form-control" value="{{ $loan->id }}"/>

            <div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">@lang('Amount')</label>

                    <div class="col-md-9">
                        <p class="mb-0"><em>${{ $loan->amount }}</em></p>
                    </div>
                </div><!--form-group-->

                <div class="form-group row">
                    <label class="col-md-3 col-form-label">@lang('Term')</label>

                    <div class="col-md-9">
                        <p class="mb-0"><em>{{ $loan->term }}</em></p>
                    </div>
                </div><!--form-group-->
            </div>
        </x-slot>
        <x-slot name="footer">
            <button class="btn btn-sm btn-primary float-lg-left" type="submit">@lang('Approve Loan')</button>
        </x-slot>

    </x-backend.card>
</x-forms.patch>
@endsection
