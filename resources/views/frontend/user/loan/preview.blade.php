@extends('frontend.layouts.app')

@section('title', __('Loan'))

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <x-forms.post :action="route('frontend.user.loan.repay')">
                <x-frontend.card>
                    <x-slot name="header">
                        @lang('Preview Loan')
                    </x-slot>

                    <x-slot name="body">

                        <input type="hidden" name="loan_id" class="form-control" value="{{ $loan->id }}"/>
                        <input type="hidden" name="transaction_id" class="form-control" value="{{ $transaction->id }}"/>

                        <div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">@lang('Outstanding Due Amount')</label>

                                <div class="col-md-9">
                                    <p class="mb-0"><em>${{ $transaction->amount }}</em></p>
                                </div>
                            </div><!--form-group-->

                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">@lang('Total Loan')</label>

                                <div class="col-md-9">
                                    <p class="mb-0"><em>${{ $loan->amount }}</em></p>
                                </div>
                            </div><!--form-group-->

                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">@lang('Due Date')</label>

                                <div class="col-md-9">
                                    <p class="mb-0"><em>{{ $transaction->due_date }}</em></p>
                                </div>
                            </div><!--form-group-->

                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">@lang('Apply On')</label>

                                <div class="col-md-9">
                                    <p class="mb-0"><em>{{ date_format($transaction->created_at,'d M Y') }}</em></p>
                                </div>
                            </div><!--form-group-->

                        </div>
                    </x-slot>

                    <x-slot name="footer">
                        <button class="btn btn-sm btn-primary float-lg-left" type="submit">@lang('Repay Loan')</button>
                    </x-slot>

                </x-frontend.card>
            </x-forms.post>
        </div><!--col-md-10-->
    </div><!--row-->
</div><!--container-->
@endsection
