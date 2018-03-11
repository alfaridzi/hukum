<ul>
@foreach($childs as $child)
	<li @if(count($child->childs)) class="edit lazy folder" @else class="edit" @endif
		data="kode_klasifikasi: '{{ $child->kode}}'"
		>
	    {{$child->kode.' - '. $child->nama }}
	@if(count($child->childs))
            @include('manageChildKlasifikasi',['childs' => $child->childs])
        @endif
	</li>
@endforeach
</ul> 