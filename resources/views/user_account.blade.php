@extends('layouts.account')

@section('image_upload')
<!-- Add icon library -->          






<div class="row">
    
    @if(isset($message)) <!-- Fix this success message -->
        <h4>{{$message}}</h4>
    @endif
 
    <div class="card col-xs-6 account" id="card" >
        <img src="user_images/{{$default_image->image_name}}" class="img-responsive" alt="Responsive image" style="width:100%">
        <h1>{{$user->name}}</h1>
        <table class='account'> 
            <tr>
                <td>Age: @if(isset($user_info->age)) {{$user_info->age}}@endif</td>
            </tr>
            <tr>
                <td>Area: @if(isset($user_info->area)) {{$user_info->area}}@endif</td>
            </tr>
            <tr>
                <td>Position: @if(isset($user_info->position)){{$user_info->position}}@endif</td> 
            </tr>
            <tr>
                <td>Competitive: @if(isset($user_info->level)){{$user_info->level}}@endif</td>
            </tr>
        </table>
        <a href="#"><i class="fa fa-dribbble"></i></a> 
        <a href="#"><i class="fa fa-twitter"></i></a> 
        <a href="#"><i class="fa fa-linkedin"></i></a> 
        <a href="#"><i class="fa fa-facebook"></i></a> 
    </div> 

    <form class="form-horizontal col-xs-6 account" method="POST" action='/info'> 
        Favorite Playing Position:
        <label class="radio-inline col-sm-6">
            <input type="radio" name="position"  value="Forward"> Forward
        </label>
        <label class="radio-inline col-sm-6">
            <input type="radio" name="position" value="Mid"> Mid
        </label>
        <label class="radio-inline col-sm-6">
            <input type="radio" name="position"  value="Defence"> Defence
        </label>
        <label class="radio-inline col-sm-6">
            <input type="radio" name="position" value="Any"> Any 
        </label>
        
        <hr> Competitve Level: <br>
        <label class="radio-inline col-sm-6">
            <input type="radio" name="level"  value="High"> High
        </label>
        <label class="radio-inline col-sm-6">
            <input type="radio" name="level" value="Medium"> Medium
        </label>
        <label class="radio-inline col-sm-6">
            <input type="radio" name="level"  value="Low"> Low
        </label>
        
        <div class="form-group">
            <label for="age" class="col-sm-2 control-label">Age</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" name="age" >
            </div>
        </div>
        <div class="form-group">
            <label for="area" class="col-sm-2 control-label">Neighborhood/Area</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="area" >
            </div>
        </div>
        {{ csrf_field() }} 
        <input type='hidden' name='xwd' value='{{Auth::user()->id}}'>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-2">
                <button type="submit" class="btn btn-default">Update Info</button>
            </div>
        </div>
    </form>
    <div class="col-xs-12"> 
        <table class='table'>
            @php $count = count($images); @endphp
            <thead>
                @for($i = 0; $i < $count; $i++)
                @if($i % 4 == 0) 
                <tr>
                    @endif
                    <td>
                        <img src="user_images/{{$images[$i]->image_name}}" class="img-responsive" alt="Responsive image" width="75" height="75" style="border-radius: 85px">
                    </td>
                    @if($i % 4 == 4)  
                </tr>
                @endif
                @endfor
            </thead>
        </table>
    </div>
    <div class="col-xs-12">
        <h1>Add Image</h1>
        <hr>
        {!! Form::open(array('route' => 'store_image', 'data-parsely-validate' => '', 'files' => true)) !!}
        {{ Form ::label('featured_image', 'Upload an Image:')}}
        {{ Form::file('featured_image') }}
        {{ Form::checkbox('default', 1) }} Default Image<br>
        {{ Form ::label('description', 'Image Note: ')}}
        {{ Form::textarea('description', null, array('class' => 'form-control')) }}

        {{ Form::submit('Upload Image', array('class', 'btn btn-success btn-lg btn-block')) }}
        {!! Form::close() !!} 
    </div>
</div>
@endsection 
