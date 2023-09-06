@extends('layouts.app')

@section('content')
    <div class="container">



        <main class="container-fluid text-center">
            <h1 class="display-4">Free Trial is over</h1>
            <p class="text-muted">Don't worry and choose your subscription plan</p>
            <!-- card-deck -->
            <div class="card-deck mt-5 mb-5 pb-4">
                <!-- card -->
                <div class="row justify-content-center">
                    @foreach($subscriptions  as $k=>$v)
                        <div class="card col-md-4 ">
                            <div class="card-header">
                                <h5>{{$v['name']}}</h5>
                            </div>
                            <!-- card-body -->
                            <div class="card-body">
                                <strong class="card-title">${{$v['price']}} </strong><span
                                    class="text-muted">/ {{$v['duration']}}</span>
                                <ul class="mt-3">
                                    <li>Well...</li>
                                    <li>512 MB of something</li>
                                    <li>Email support (most likely)</li>
                                    <li>0 GB of storage</li>
                                </ul>
                                <a class="btn btn-outline-primary mr-3" href="{{url(route('plan.show',$v['slug']))}}"
                                   class="btn">Choose Plan</a>

                            </div>
                            <!-- /card-body -->

                            <!-- /card -->

                            <!-- /card -->
                        </div>
                    @endforeach
                </div>
            </div>
                <!-- /card-deck -->
                <hr>
        </main>


    </div>

@endsection
