@extends('layouts.app')

@section('locations')
@guest
<div class="alert alert-danger" role="alert">
    <p>
        <strong>
            Please create an account or log in
            to vote for a game!
        </strong>
    </p>
</div>
@endguest
 
<div class="row" style='background: white;'>
@foreach($fields as $field)
@php $images_count = count($images[$field->name]); @endphp
    <div class="col-sm-6 col-md-4">
        <div class="thumbnail">
            <!-- Wrapper for carousel items -->
            <div class="carouselContainer">
            @foreach($images[$field->name] as $image)
                <div>
                    <img src="images/{{$field->name}}/{{$image->image_name}}">
                </div>
            @endforeach
            </div>
            <div class="caption">
                <h3>{{$field->name}}</h3>
                <p id="{{$field->id}}">Total Votes: <span>{{$field->votes}}</span></p>
                <table class="table">Players:
                    @php $count = count($field->player_images); @endphp
                    <thead>
                    @for($i = 0; $i < $count; $i++)
                        @if($i % 4 == 0) 
                        <tr>
                        @endif
                            <td>
                                <img src="user_images/{{$field->player_images[$i]->image_name}}" class="img-responsive" alt="Responsive image" width="75" height="75" style="border-radius: 85px">
                            </td>
                        @if($i % 4 == 4)  
                        </tr>
                        @endif
                    @endfor
                    </thead>
                </table>
                @if (Auth::user())
                <button class="btn btn-primary up_vote" data-user="{{Auth::user()->id}}" data-field="{{$field->id}}" data-quantity="1">Vote</button>
                <button class="btn btn-danger down_vote" data-user="{{Auth::user()->id}}" data-field="{{$field->id}}" data-quantity="-1" role="button">Remove Vote</button></p>
                @endif
            </div>
        </div>
    </div> 
@endforeach  
    



<script type="text/javascript">
    $(document).ready(function () {
        $(".carouselContainer").slick({ 
            dots: true,
            arrows: true,
            lazyLoad: 'ondemand', // ondemand progressive anticipated
            infinite: true
        });
        $.each($(".up_vote, .down_vote"), function(index, value){
            $(value).click(function () {
                var field_id = $(this).attr("data-field");
                var user_id = $(this).attr("data-user");
                var quantity = $(this).attr("data-quantity");
                var span = $("#"+field_id).children("span");
                var current_val = parseInt($(span).text());
                
                $.ajax({
                    type: 'POST',
                    url: 'vote',
                    processData: true,
                    dataType: 'json',
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    data: {quantity: quantity, user_id: user_id, field_id: field_id},
                    success: function (data)
                    {
                        var new_val = current_val + parseInt(quantity);
                        $(span).text(new_val);
                        if(data.votes >= 8)
                        {
                            alert("Game on bitches!");
                        }
                    },
                    error: function (data)
                    {
                        console.log(data);
                        //TODO This warning should appear if a player has already voted for a game.
                        //Find out how to return an error response so that this block of code
                        //is executed.
//                        alert('You already voted for this game');
                    }
                });
            });
        });
        
        
    });
</script>
<script type="text/javascript">
    function createGame(url)
    {
        $.ajax({
            type: 'POST',
            url: 'game/create',
            processData: true,
            dataType: 'json',
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: {field_id: 1, user_id: user_id, field_id: field_id},
            success: function (data)
            {
                location.reload(true);
            },
        });
    }
</script>
@endsection