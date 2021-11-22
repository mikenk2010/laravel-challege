@extends('frontend.layouts.app')

@section('title', __('Loan'))

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <x-frontend.card>
                <x-slot name="header">
                    @lang('Loan')
                </x-slot>

                <x-slot name="headerActions">
                    <x-utils.link
                        icon="c-icon cil-plus"
                        class="card-header-action"
                        :href="route('frontend.user.loan.apply')"
                        :text="__('Apply Loan')"
                    />
                </x-slot>

                <x-slot name="body">
                    <livewire:loans-table/>
                </x-slot>
            </x-frontend.card>
        </div><!--col-md-10-->
    </div><!--row-->
</div><!--container-->
@endsection
