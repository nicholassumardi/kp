@extends('layouts/app')

@section('content')

<div class="container padding">
    
    <div class="row text-start mt-4" data-aos="fade-right" data-aos-duration="1000" data-aos-delay="1400">
        <div class="col-sm-9 aboutme">
            <h1>ITATS <br>LANGUAGE CENTER</h1>
            <hr class="solid">
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6 aboutmedesc" data-aos="fade-right" data-aos-duration="1000" data-aos-delay="1400">
            <h5>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi nisi voluptate non quae vero labore eos ea quas quo praesentium libero officiis, eaque voluptatem asperiores doloremque. Adipisci facere consectetur aspernatur.!</h5>
        </div>
    </div>

    <div class="row mt-2 mb-3" data-aos="fade-right" data-aos-duration="1000" data-aos-delay="1400" data-aos-once="true">
        <div class="col-sm">
            <button type="button" class="btn btn-lg col-sm-4 custombutton shadow">Sign In</button>
        </div>
    </div>

    <div class="row fixed-bottom logohero" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="900">
        <div class="col-md">
            <img src="{{asset('images/human.png')}}" alt="" class="logohero">
        </div>
    </div>

    
    
</div>

@endsection