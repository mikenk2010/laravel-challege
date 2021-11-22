@extends('frontend.layouts.app')

@section('title', __('Loan'))

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <x-forms.post :action="route('frontend.user.loan.repay')">
                <x-frontend.card>
                    <x-slot name="header">
                        @lang('Current Loan')
                    </x-slot>


                    <x-slot name="body">

                        <input type="hidden" name="amount" class="form-control" value="{{ $loan->amount }}"/>
                        <input type="hidden" name="term" class="form-control" value="{{ $loan->term }}"/>

                        @foreach ($loans as $item)
                        <div>
                            <div class="form-group row">
                                <label for="name" class="col-md-2 col-form-label">@lang('ID')</label>

                                <div class="col-md-10">
                                    {{ $item->id }}
                                </div>
                            </div><!--form-group-->

                            <div class="form-group row">
                                <label for="name" class="col-md-2 col-form-label">@lang('Due Amount')</label>

                                <div class="col-md-10">
                                    ${{ $item->amount }}
                                </div>
                            </div><!--form-group-->

                            <div class="form-group row">
                                <label for="name" class="col-md-2 col-form-label">@lang('Status')</label>

                                <div class="col-md-10">
                                    {{ $item->status }}
                                </div>
                            </div><!--form-group-->

                            <div class="form-group row">
                                <label for="name" class="col-md-2 col-form-label">@lang('Payment Due Date')</label>

                                <div class="col-md-10">
                                    {{ $item->due_date }}
                                </div>
                            </div><!--form-group-->


                            <div class="form-group row">

                                <div class="col-md-10">

                                    @if ($item->status == 2)
                                    <span class="btn btn-sm btn-success float-lg-left">Paid</span>
                                    @elseif ($item->status == 1)
                                    <x-utils.link class="btn btn-sm btn-outline-info float-lg-left card-header-action"
                                                  :href="route('frontend.user.loan.repay.preview', ['loan' => $loan->id, 'transaction_id' => $item->id])"
                                                  :text="__('Preview Repay')"/>
                                    @else
                                    <span class="btn btn-sm btn-warning float-lg-left">Pending</span>
                                    @endif

                                </div>
                            </div><!--form-group-->

                        </div>


                        <hr/>

                        @endforeach

                    </x-slot>


                </x-frontend.card>
            </x-forms.post>
        </div><!--col-md-10-->
    </div><!--row-->
</div><!--container-->
@endsection
