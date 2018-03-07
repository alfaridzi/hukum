<ul>
@foreach($childs as $child)
	<li @if(count($child->childs)) class="edit lazy folder" @else class="edit" @endif

		data="id: '{{ $child->id }}',status: '{{ $child->id_status }}', jabatan: '{{ $child->jabatan }}',id_grup: '{{ $child->id_grup }}',parent_id: '{{ $child->parent_id }}'

		">
	    {{ $child->title }}
	@if(count($child->childs))
            @include('manageChild',['childs' => $child->childs])
        @endif
	</li>
@endforeach
</ul> 