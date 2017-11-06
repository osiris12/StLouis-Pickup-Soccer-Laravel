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
@php $now = _now(true); @endphp
<div class="row home">
    <h1 style="text-align: center; margin-bottom: 15px; margin-top: 15px">{{$now}}</h1>
    <button id="collapseGames" class="btn btn-success" onclick=""> Game List</button>
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    @foreach($fields as $field)
        <div class="panel panel-default">
            <div class="panel-heading bg-primary" role="tab" id="heading-{{$field->id}}">
                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse-{{$field->id}}" aria-expanded="true" aria-controls="collapse-{{$field->id}}" >
                <h4 class="panel-title" style="color: white;">
                    {{$field->name}}: <span style='float: right;'>Votes: {{$field->votes}}</span>
                </h4>
                </a>
            </div> 
            <div id="collapse-{{$field->id}}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading-{{$field->id}}">
                <div class="panel-body">
                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail">
                            <!-- Wrapper for carousel items -->
                            <div class="carouselContainer">
                                @php $images_count = count($images[$field->name]);  @endphp
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
                                    @php $count = count($field->players_info->player_images); @endphp
                                    <thead>
                                        @for($i = 0; $i < $count; $i++)
                                        @if($i % 4 == 0) 
                                        <tr>
                                            @endif
                                            <td>
                                                <a data-user-image="{{$field->id}} - {{$field->players_info->player_ids[$i]}}" href="/account/{{$field->players_info->player_ids[$i]}}">
                                                    <img src="user_images/{{$field->players_info->player_images[$i]->image_name}}" class="img-responsive" alt="Responsive image" width="75" height="75" style="border-radius: 85px">
                                                </a>
                                            </td>
                                            @if($i % 4 == 4)  
                                        </tr>
                                        @endif
                                        @endfor
                                    </thead>
                                </table>
                                @if (Auth::user())
                                <button class="btn btn-primary up_vote" data-user="{{Auth::user()->id}}" data-field="{{$field->id}}" data-quantity="1"><strong>I'm In!</strong></button>
                                            <button class="btn btn-danger down_vote" data-user="{{Auth::user()->id}}" data-field="{{$field->id}}" data-quantity="-1" role="button"><strong>I'm Out!</strong></button></p>
                                @endif
                            </div>
                        </div>
                    </div> 
                </div>
            </div>  
        </div>
        @endforeach  
    </div>
</div>






<script type="text/javascript">
    $(document).ready(function () {
        collapseGames();
        $(".carouselContainer").slick({
            lazyLoad: 'ondemand', // ondemand progressive anticipated
            infinite: true
        });
        $.each($(".up_vote, .down_vote"), function (index, value) {
            $(value).click(function () {
                var field_id = $(this).attr("data-field");
                var user_id = $(this).attr("data-user");
                var quantity = $(this).attr("data-quantity");
                var span = $("#" + field_id).children("span");
                var current_val = parseInt($(span).text());
                var string = field_id + " - " + user_id;

                $.ajax({
                    type: 'POST',
                    url: 'vote',
                    processData: true,
                    dataType: 'json',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: {quantity: quantity, user_id: user_id, field_id: field_id},
                    success: function (data)
                    {
                        console.log(data.status);
                        var new_val = current_val + parseInt(quantity);
                        $(span).text(new_val);
                        if (data.votes >= 8)
                        {
                            alert("Game on bitches!");
                        }
                        if (data.status == 'remove')
                        {
                            $("a[data-user-image='" + string + "']").empty();
                        }
                    },
                    error: function (data)
                    {
                        if (data.responseJSON.type == 'upvote')
                        {
                            alert('You already voted for this game');
                        } else
                        {
                            alert('You have not voted for this game');
                        }
                    }
                });
            });
        });
    });

    function collapseGames()
    {
        $("#collapseGames").click(function () {
            $.each($(".panel-collapse"), function (index, value) {
                $(value).removeClass("in");
            });
        });
    }
</script>

@endsection