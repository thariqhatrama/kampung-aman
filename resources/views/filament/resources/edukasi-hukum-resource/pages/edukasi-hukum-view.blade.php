<x-filament-panels::page>
  <div class="text-sm">
    <p>Kategori: <span class="text-orange-500">{{ $record->jenis_edukasi->nama }}</span></p>
  </div>
  <div>
    {!! $record->deskripsi !!}
  </div>
  <div>
    <iframe type="application/pdf" src="{{ asset('storage/'.$record->file) }}" class="w-full h-screen"></iframe>
  </div>
</x-filament-panels::page>
