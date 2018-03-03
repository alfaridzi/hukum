<ul>
@foreach($childs as $child)
	<li id="{{ $child->id }}">
	    {{ $child->title }}
	@if(count($child->childs))
            @include('manageChild',['childs' => $child->childs])
        @endif
	</li>
@endforeach
</ul>