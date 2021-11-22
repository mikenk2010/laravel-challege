

@if ($model->status != 0)
<x-utils.view-button :href="route('frontend.user.loan.show', $model)"/>
@else
<span class="btn btn-sm btn-warning float-lg-left">Wating for approve</span>
@endif


