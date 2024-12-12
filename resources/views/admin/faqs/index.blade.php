@extends('admin.layouts.app')
@section('content')
    {{-- <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div> --}}
    <!-- End Page Title -->
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $title }}</h5>
                        <form method="GET" action="{{ route('admin.faqs.index') }}" class="mb-3">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="input-group gap-2">
                                        <input type="text" name="search" class="form-control"
                                            placeholder="Search by name or email" value="{{ request('search') }}">
                                        <button class="btn btn-primary" type="submit">Search</button>
                                    </div>


                                </div>
                                <div class="col-lg-2">
                                    <a href="{{ route('admin.faqs.index') }}" class="btn btn-secondary">Reset</a>
                                </div>
                                <div class="col-lg-2">
                                    <a href="{{ route('admin.faqs.create') }}" class="btn btn-secondary">Add</a>
                                </div>
                            </div>
                        </form>
                        <div class="row">

                        </div>
                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>
                                        Title
                                    </th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="users-body">
                                @foreach ($faqs as $index => $faq)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $faq->title }}</td>
                                        <td>
                                            <a href="{{ route('admin.faqs.edit', $faq->id) }}">Edit</a>
                                            <form action="{{ route('admin.faqs.destroy', $faq->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
