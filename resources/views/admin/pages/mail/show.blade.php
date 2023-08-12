@extends('admin.layouts.app')
@section('title', 'Mail ' . $mail->subject)

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="boxs mail_listing">
                                <div class="inbox-center table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th colspan="1">
                                                    <div class="inbox-header">
                                                        Subject: {{ $mail->subject }}
                                                    </div>
                                                </th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                <div class="card-body">
                                    <div class="clearfix mb-3"></div>
                                    <div class="table-responsive">
                                        @if ($emailData->count() > 0)
                                        <table class="table table-striped" id="table-2">
                                            <thead>
                                                <tr>
                                                    <th class="pt-2">
                                                        #
                                                    </th>
                                                    <th>Email</th>
                                                    <th>Status</th>
                                                    <th>Delivery time</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($emailData as $key => $data)
                                                    <tr id="{{ $data->id }}">
                                                        <td>
                                                            {{ ++$key }}
                                                        </td>
                                                        <td>
                                                            {{ $data->email }}
                                                        </td>
                                                        <td>
                                                            @if ($data->status == '2')
                                                                <div class="badge badge-danger">Error</div>
                                                            @elseif($data->status == '1')
                                                                <div class="badge badge-success">Sent</div>
                                                            @else
                                                                <div class="badge badge-warning">Pending</div>
                                                            @endif
                                                        </td>
                                                        <td>{{ $data->send_time ? Carbon\Carbon::createFromTimestamp($data->send_time)->format('M d, Y H:i:sA') : 'Not delivered' }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        @else
                                            <p class="text-center text-muted">No data to show!</p>
                                        @endif
                                    </div>

                                </div>
                            </div>
                            <div class="card-footer">
                                <div></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('backend/assets/bundles/datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
@endsection

@section('scripts')
    <script src="{{ asset('backend/assets/bundles/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('backend/assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/page/datatables.js') }}"></script>
@endsection
