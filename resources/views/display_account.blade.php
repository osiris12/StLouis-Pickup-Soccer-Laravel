@extends('layouts.account')

@section('display_account')
<!-- Add icon library -->          


<div class="row home" style='margin-left: 0px; margin-right: 0px;'>
    <div class="card account" id="card" >
        <img src="{{env('URL')}}user_images/{{$default_image->image_name}}" class="img-responsive" alt="Responsive image" style="width:100%">
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

    <div class="col-xs-12"> 
        <table class='table'>
            @php $count = count($images); @endphp
            <thead>
                @for($i = 0; $i < $count; $i++)
                @if($i % 4 == 0) 
                <tr>
                    @endif
                    <td>
                        <img src="{{env('URL')}}user_images/{{$images[$i]->image_name}}" class="img-responsive" alt="Responsive image" width="75" height="75" style="border-radius: 85px">
                    </td>
                    @if($i % 4 == 4)  
                </tr>
                @endif
                @endfor
            </thead>
        </table>
    </div>
</div>
@endsection 
