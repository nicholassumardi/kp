@extends('frontpages/home/layouts/app')

@section('content')

<div class="container padding">

    <div class="row text-start mt-4" data-aos="fade-right" data-aos-duration="1000" data-aos-delay="1400">
        <div class="col-sm-9 aboutme">
            <h2>ITATS</h2>
            <h2>LANGUAGE CENTER</h2>
            <hr class="solid">
        </div>
    </div>

    <div class="row">
        <div class="col-sm-5 aboutmedesc" data-aos="fade-right" data-aos-duration="1000" data-aos-delay="1400">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi debitis, ex similique est totam temporibus modi sit nemo? Molestiae dolorem obcaecati suscipit id iusto maiores nulla reprehenderit cupiditate, neque recusandae!
            </p>
        </div>
    </div>

    <div class="row mt-2 mb-3" data-aos="fade-right" data-aos-duration="1000" data-aos-delay="1400"
        data-aos-once="true">
        <div class="col-sm">
            <a href="/sign_in"><button type="button" class="btn btn-lg col-sm-4 custombutton shadow">Sign In</button></a>
        </div>
    </div>

    <div class="row col-l" data-aos="fade-right" data-aos-duration="1000" data-aos-delay="1400" data-aos-once="true">
        <div class="container ms-1 text-center">
            <div class="social mt-2 mb-3"> <i class="mx-2 fa fa-facebook-official fa-lg"></i> <i
                    class="mx-2 fa fa-instagram fa-lg"></i> <i class="mx-2 fa fa-twitter fa-lg"></i> <i
                    class="mx-2 fa fa-linkedin-square fa-lg"></i> </div>
        </div>
    </div>



    <div class="row fixed-bottom logohero" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="900">
        <div class="col-md">
            <img src="{{asset('images/human.png')}}" alt="" class="logohero">
        </div>
    </div>



</div>

@endsection