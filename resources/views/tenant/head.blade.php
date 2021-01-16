<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
    <title>{{ $pageTitle }}</title>
    @if(isset($metaElements))
        @foreach($metaElements as $el)
            <meta @foreach($el as $k => $v) {{ $k }}="{{ $v }}"@endforeach />
        @endforeach
    @endif

    @if(!empty($cssElements))
        @foreach($cssElements as $el)
            <link type="text/css" rel="stylesheet" href="{{ $el['location'] }}" @foreach($el['attributes'] as $k => $v) {{ $k }}="{{ $v }}" @endforeach />
        @endforeach
    @endif

    @if(!empty($javascriptElements))
        @include('common/javascriptElements', ['javascriptElements' => $javascriptElements])
    @endif

    <link rel="stylesheet" href="{{ mix('/assets/tenant/css/app.css') }}"/>
    <script src="{{ mix('/assets/tenant/js/jquery.js') }}"></script>
</head>
