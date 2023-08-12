@extends('admin.layouts.app')
@section('title', 'Sent Mails')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-0">
                        <div class="card-body">
                            <ul class="nav nav-pills">
                                <li class="nav-item">
                                    <a class="nav-link active "
                                        href="#}">All <span
                                            class="badge badge-white">{{ $mails->count() }}</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.mail.send') }}">Compose mail <span
                                            class="badge badge-primary"><i data-feather="mail"></i></span></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Sents Mails</h4>
                        </div>
                        <div class="card-body">
                            <div class="clearfix mb-3"></div>
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-2">
                                    <thead>
                                        <tr>
                                            <th class="pt-2">
                                                #
                                            </th>
                                            <th>To</th>
                                            <th>Subject</th>
                                            <th>Body</th>
                                            <th>Sender</th>
                                            <th>Created At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($mails as $key => $mail)
                                            <tr id="{{ $mail->slug }}">
                                                <td>
                                                    {{ ++$key }}
                                                </td>
                                                <td>

                                                    @if ($mail->to == 'all')
                                                    All users
                                                    @elseif($mail->to == 'admin')
                                                    Only admins
                                                    @elseif($mail->to == 'writer')
                                                    Only authors
                                                    @elseif($mail->to == 'manualMail')
                                                    Manually inputed emails
                                                    @endif

                                                    <div class="table-links">
                                                        <a href="{{ route('admin.mail.show', $mail->id) }}">View</a>
                                                        {{-- <div class="bullet"></div>
                                                        <a href="{{ route('admin.mails.edit', $mail->slug) }}">Edit</a>

                                                        <div class="bullet"></div>
                                                        <a href="javascript: void(0)" class="text-danger delete-link"
                                                        data-post-id="{{ $mail->slug }}">Trash</a> --}}
                                                    </div>
                                                </td>
                                                <td>
                                                    {{ $mail->subject  }}
                                                </td>
                                                <td>
                                                    {{ Str::limit(strip_tags($mail->body), 250, '...')  }}
                                                </td>
                                                <td>{{ $mail->user->name }}</td>
                                                <td>{{ $mail->created_at->format('M d, Y') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

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
