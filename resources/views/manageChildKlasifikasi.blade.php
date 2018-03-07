<ul>
@foreach($childs as $child)
	<li @if(count($child->childs)) class="edit lazy folder" @else class="edit" @endif
		data="id: '{{ $child->id }}',kode: '{{ $child->kode }}', status: '{{ $child->id_status }}', penyusutan_akhir: '{{ $child->penyusutan_akhir }}',rAktif: '{{ $child->rAktif }}',rInaktif: '{{ $child->rInaktif }}',deskripsi: '{{ $child->deskripsi }}',nama: '{{ $child->nama }}',parent_id: '{{ $child->parent_id }}'"
		>
	    {{$child->kode.' - '. $child->nama }}
	@if(count($child->childs))
            @include('manageChildKlasifikasi',['childs' => $child->childs])
        @endif
	</li>
@endforeach
</ul> 