<div class="row">
    <div class="col-12">
        @if(isset($content))
            @include($content)
        @else
            @include('exception')
        @endif
    </div>
</div>
