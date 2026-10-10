<h1>Tips Fitness</h1>

@foreach($tips as $tip)
    <h2>{{ $tip->get('tip') }}</h2>
@endforeach