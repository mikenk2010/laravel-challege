@extends('frontend.layouts.app')

@section('title', __('Loan'))

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <x-forms.post :action="route('frontend.user.loan.store')">
                <x-frontend.card>
                    <x-slot name="header">
                        @lang('Apply Loan')
                    </x-slot>

                    <x-slot name="body">
                        <div>
                            <div class="form-group row">
                                <label for="amount" class="col-md-2 col-form-label">@lang('Amount')</label>

                                <div class="col-md-10">
                                    <input type="number" name="amount" class="form-control" placeholder="{{ __('Amount') }}" required/>
                                </div>
                            </div><!--form-group-->

                            <div class="form-group row">
                                <label for="term" class="col-md-2 col-form-label">@lang('Term')</label>

                                <div class="col-md-10">
                                    <select name="term" class="form-control" required>
                                        <option value="1">1 Month</option>
                                        <option value="2">2 Months</option>
                                        <option value="3">3 Months</option>
                                    </select>
                                </div>
                            </div><!--form-group-->

                            <div class="form-group row">
                                <label for="name" class="col-md-2 col-form-label">@lang('Note*')</label>

                                <div class="col-md-10">
                                    <p class="mb-0"><em>You need to repay weekly</em></p>
                                </div>
                            </div><!--form-group-->

                        </div>
                    </x-slot>

                    <x-slot name="footer">
                        <button class="btn btn-sm btn-primary float-lg-left" type="submit">@lang('Apply Loan')</button>
                    </x-slot>

                </x-frontend.card>
            </x-forms.post>
        </div><!--col-md-10-->
    </div><!--row-->
</div><!--container-->
@endsection
