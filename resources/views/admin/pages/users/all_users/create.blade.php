@extends('admin.layouts.app')
@section('title', 'Create ' . $type)

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">

                        <div class="card">
                            <div class="card-header">
                                <h4>Add {{ Str::ucfirst($type) }}</h4>
                            </div>
                            @if (isset($user))
                            @livewire('admin.users', ['type' => $type, 'user' => isset($user) ? $user : null])
                            @else
                            @livewire('admin.users', ['type' => $type])
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('scripts')
    <Script>
        window.addEventListener('userCreated', (event) => {
            // alert('A mail as been sent to this email. \n The default password is ' + event.detail.data)
            swal('Created', 'A mail as been sent to this email. \n The default password is ' + event.detail.data,  'success');
        })
    </Script>
@endsection
