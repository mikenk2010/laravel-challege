@if ($model->status == 0)
<x-utils.view-button :href="route('admin.auth.loan.show', $model)"/>
@else
<span class="btn btn-sm btn-success float-lg-left">Approved</span>
@endif
