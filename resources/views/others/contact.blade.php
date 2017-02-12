@extends('layouts.main')


@section('content')
   @include('partials.errors')
    <div class="row">
        @if(Session::has('info'))
        <div class="col-md-12">
            <p class="alert alert-info">
                {{Session::get('info')}}
            </p>
        </div>
        @endif
        <div class="col-md-12">
            <form action="{{ route('others.contact') }}" method="post">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>
                <div class="form-group">
                    <label for="content">Message</label>
                    <input type="text" class="form-control" id="message" name="message">
                </div>
                {{ csrf_field() }}
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
