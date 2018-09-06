<ul>
@foreach($childs as $child)
	<li>
	    {{ $child->name }}
	@if(count($child->childs))
            @include(' ',['childs' => $child->childs])
        @endif
	</li>
@endforeach
</ul>