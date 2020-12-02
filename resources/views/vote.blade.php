@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Vote</div>

                <div class="card-body">
                    @if(!$userHasVoted)
                        <form class="form" method="POST" action="{{ route('vote.do') }}">
                            @csrf
                            @error('form')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                            @enderror
                            <button class="btn btn-lg btn-danger" name="mood" value="0">@mood(0)</button>
                            <button class="btn btn-lg btn-dark" name="mood" value="1">@mood(1)</button>
                            <button class="btn btn-lg btn-success" name="mood" value="2">@mood(2)</button>
                        </form>
                    @else
                        <p class="mb-0">You already voted today, please come back tomorrow.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
