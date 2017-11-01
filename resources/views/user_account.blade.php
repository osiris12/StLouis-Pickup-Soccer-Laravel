@extends('layouts.app')

@section('image_upload')
<!-- Add icon library -->







<div class="row">
    <div class="card col-xs-12 " id="card" >
        <img src="user_images/{{$default_image->image_name}}" class="img-responsive" alt="Responsive image" style="width:100%">
        <h1>{{$user->name}}</h1>
        <p class="title">CEO & Founder, Example</p>
        <p>Harvard University</p>
        <a href="#"><i class="fa fa-dribbble"></i></a> 
        <a href="#"><i class="fa fa-twitter"></i></a> 
        <a href="#"><i class="fa fa-linkedin"></i></a> 
        <a href="#"><i class="fa fa-facebook"></i></a> 
        <p><button>Message</button></p>
    </div>
    <div class="col-xs-12"> 
    <table class='table'>
        <thead>
            @foreach($images as $image)
            <td>
                <img src="user_images/{{$image->image_name}}" class="img-responsive" alt="Responsive image" width='200' height='200'>  
            </td> 
            @endforeach 
        </thead>  
    </table>
    </div>
    <div class="col-xs-12">
        <h1>Add Image</h1>
        <hr>
        {!! Form::open(array('route' => 'store_image', 'data-parsely-validate' => '', 'files' => true)) !!}
        {{ Form ::label('featured_image', 'Upload Featured Image:')}}
        {{ Form::file('featured_image') }}
        {{ Form::checkbox('default', 1) }} Default Image<br>
        {{ Form ::label('description', 'Images Description: ')}}
        {{ Form::textarea('description', null, array('class' => 'form-control')) }}

        {{ Form::submit('Upload Image', array('class', 'btn btn-success btn-lg btn-block')) }}
        {!! Form::close() !!}
    </div>
</div>
@endsection