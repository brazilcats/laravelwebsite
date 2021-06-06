@extends('layouts.front')

@section('content')


<div class="row">

    <link rel="stylesheet" type="text/css" href="{{ asset('public/js/Magnifier.js-master/magnifier.css')}}">

    <div class="col-12">

      <a class="magnifier-thumb-wrapper">
        <img id="thumb" src="{{ asset('public/assets/img/Mapa.jpg')}}" alt="mapa" class="img-fluid">
      </a>


    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript" src="{{ asset('public/js/Magnifier.js-master/Event.js')}}"></script>
<script type="text/javascript" src="{{ asset('public/js/Magnifier.js-master/Magnifier.js')}}"></script>
<script type="text/javascript" src="{{ asset('public/js/Magnifier.js-master/Gallery.js')}}"></script>

<script type="text/javascript">
  var evt = new Event(),
      m = new Magnifier(evt);

    m.attach({
    thumb: '#thumb',
    large: "{{ asset('public/assets/img/Mapa.jpg')}}",
    mode: 'inside',
    zoom: 3,
    zoomable: true
    });

</script>
@endsection