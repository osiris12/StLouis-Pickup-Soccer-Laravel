@extends('layouts.account')


@section('test')

<section class="lazy slider">
    <div><img src="../user_images/1509225175.jpg"  ></div>
    <div><img src="../user_images/1509225822.jpg"  ></div>
    <div><img src="../user_images/1509225841.jpg"  ></div>
</section>


<script type="text/javascript">
    $(document).ready(function () {
        $(".lazy").slick({
        });
    });
</script> 
@endsection