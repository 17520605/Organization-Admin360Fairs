@extends('layouts.partner')

@section('content')
<div class="container-fluid booths-card">
    <div class="container-fluid">
        <!-- Account page navigation-->
        <h3>Overview Booths</h3>
        <hr class="mt-0 mb-4">
        <div class="row">
            <div class="col-lg-4 mb-4">
                <!-- Billing card 1-->
                <div class="card h-100 border-start-lg border-start-primary">
                    <div class="card-body">
                        <div class="small text-muted">Current monthly bill</div>
                        <div class="h3">$20.00</div>
                        <a class="text-arrow-icon small" href="#!">
                            Switch to yearly billing
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <!-- Billing card 2-->
                <div class="card h-100 border-start-lg border-start-secondary">
                    <div class="card-body">
                        <div class="small text-muted">Next payment due</div>
                        <div class="h3">July 15</div>
                        <a class="text-arrow-icon small text-secondary" href="#!">
                            View payment history
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <!-- Billing card 3-->
                <div class="card h-100 border-start-lg border-start-success">
                    <div class="card-body">
                        <div class="small text-muted">Current plan</div>
                        <div class="h3 d-flex align-items-center">Freelancer</div>
                        <a class="text-arrow-icon small text-success" href="#!">
                            Upgrade plan
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-header-actions mb-4">
            <div class="card-header">
                Payment Methods
                <button class="btn btn-sm btn-primary" type="button">Add Payment Method</button>
            </div>
        </div>
    </div>
</div>
@endsection
