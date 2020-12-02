@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Average mood</div>

                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-4">
                                <h2>Daily</h2>
                                <h3>@mood($statistics->dailyAverage)</h3>
                            </div>
                            <div class="col-4">
                                <h2>Weekly</h2>
                                <h3>@mood($statistics->weeklyAverage)</h3>
                            </div>
                            <div class="col-4">
                                <h2>Monthly</h2>
                                <h3>@mood($statistics->monthlyAverage)</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
