@extends('layouts.app')

@section('content')
    <div class="container">

        @if(session('message'))
            <div class="alert alert-success" role="alert">
                {{session('message')}}
            </div>

        @endif
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">User Name</th>
                <th scope="col">Plan</th>
                <th scope="col">Duration</th>
                <th scope="col">Price</th>
                <th scope="col">Status</th>
                <th scope="col">Payment Type</th>
                <th scope="col">Ends At</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($subscriptions as $k=>$sub)
            <tr>
                <th scope="row">{{++$k}}</th>
                <td>{{$sub->user_name}}</td>
                <td>{{$sub->name}}</td>
                <td>{{$sub->duration}}</td>
                <td>${{$sub->price}}</td>
                <td>{{$sub->stripe_status}}</td>
                <td>{{$sub->pm_type}}</td>
                <td>{{ (!empty($sub->ends_at)?date("M-d-Y",strtotime($sub->ends_at)):'--');}}</td>
            <td>
                @if($sub->stripe_status=='deactivate')
                    <a href="javascript:void(0)" style="color: red"> Canceled</a>
                 @else
                <a href="{{url(route('sub.cancel',$sub->sub_id))}}"> Cancel</a>
                   @endif
            </td>
            </tr>
            @endforeach

            </tbody>
        </table>




    </div>

@endsection
