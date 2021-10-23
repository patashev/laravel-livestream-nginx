@extends('layouts.admin')
@section('content')
<style>
.vjs-social-share{ top: 0px; right: 0; margin: 5px; position: absolute; }
.vjs-watermark img { max-height: 100px !important; margin: 10px !important; }
</style>


<div class="row">
  <div class="col-sm-12">
    @include('admin.stats.partials.ipToLocationBars')
  </div>
</div>
@endsection
