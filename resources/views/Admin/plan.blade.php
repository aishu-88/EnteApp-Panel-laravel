@extends('layouts.admin')

@section('content')
<div class="container-fluid">

    <div class="row mb-4">
        <div class="col">
            <h4 class="mb-0">Create Plan</h4>
            <small class="text-muted">Manage subscription plans</small>
        </div>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Validation Errors --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- CREATE PLAN --}}
    <div class="card">
        <div class="card-body">

            <form method="POST" action="">
                @csrf

                {{-- Title --}}
                <div class="mb-3">
                    <label class="form-label">Plan Title</label>
                    <input type="text" name="title" class="form-control"
                           placeholder="Eg: Basic Plan" required>
                </div>

                {{-- Description --}}
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="3"
                              placeholder="Short plan description" required></textarea>
                </div>

                {{-- Amount --}}
                <div class="mb-3">
                    <label class="form-label">Amount (₹)</label>
                    <input type="number" name="amount" class="form-control"
                           placeholder="Eg: 499" required>
                </div>

                {{-- Buttons --}}
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Save Plan</button>
                    <a href="{{ route('admin.admin.plan') }}" class="btn btn-secondary">Cancel</a>
                </div>

            </form>

        </div>
    </div>

    {{-- PLAN LIST --}}
    @if(isset($plans))
    <div class="card mt-4">
        <div class="card-body">
            <h5 class="mb-3">Existing Plans</h5>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($plans as $plan)
                        <tr>
                            <td>{{ $plan->title }}</td>
                            <td>{{ $plan->description }}</td>
                            <td>₹{{ $plan->amount }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">No plans found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>
    @endif

</div>
@endsection
