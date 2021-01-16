@if(!empty($javascriptElements))
    @foreach($javascriptElements as $el)
        <script type="text/javascript" src="{{ $el['location'] }}" @if(!empty($el['attributes'])) @foreach($el['attributes'] as $att => $value) {{ $att }}=@if($value === true)true @elseif($value === false)false @else"{{ $value }}"@endif @endforeach @endif></script>
    @endforeach
@endif