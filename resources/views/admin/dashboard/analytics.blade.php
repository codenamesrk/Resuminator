@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
    <div id="temps_div"></div>
    @columnchart('Dropoffs', 'temps_div')
    </div>
</div>
@endsection