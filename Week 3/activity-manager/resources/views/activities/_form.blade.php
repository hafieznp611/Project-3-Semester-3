<div class="form-group">
    <label for="title">Judul</label>
    <input id="title" name="title" value="{{ old('title', $activity->title ?? '') }}">
    @error('title')
        <p class="error">{{ $message }}</p>
    @enderror
</div>

<div class="form-group">
    <label for="code">Kode Kegiatan</label>
    <input id="code" name="code" value="{{ old('code', $activity->code ?? '') }}">
    @error('code')
        <p class="error">{{ $message }}</p>
    @enderror
</div>

<div class="form-group">
    <label for="description">Deskripsi</label>
    <textarea id="description" name="description">{{ old('description', $activity->description ?? '') }}</textarea>
    @error('description')
        <p class="error">{{ $message }}</p>
    @enderror
</div>

<div class="form-row">
    <div class="form-group">
        <label for="start_at">Tanggal Mulai</label>
        <input type="date" id="start_at" name="start_at"
            value="{{ old('start_at', isset($activity) ? $activity->start_at->format('Y-m-d') : '') }}">
        @error('start_at')
            <p class="error">{{ $message }}</p>
        @enderror
    </div>

    <div class="form-group">
        <label for="end_at">Tanggal Selesai</label>
        <input type="date" id="end_at" name="end_at"
            value="{{ old('end_at', isset($activity) ? $activity->end_at->format('Y-m-d') : '') }}">
        @error('end_at')
            <p class="error">{{ $message }}</p>
        @enderror
    </div>
</div>

<div class="form-group">
    <label for="location">Lokasi</label>
    <input id="location" name="location" value="{{ old('location', $activity->location ?? '') }}">
    @error('location')
        <p class="error">{{ $message }}</p>
    @enderror
</div>

<div class="form-group">
    <label for="capacity">Kapasitas</label>
    <input type="number" id="capacity" name="capacity" value="{{ old('capacity', $activity->capacity ?? '') }}">
    @error('capacity')
        <p class="error">{{ $message }}</p>
    @enderror
</div>

<div class="form-group">
    <label for="category_id">Kategori</label>
    <select id="category_id" name="category_id">
        <option value="">-- Pilih Kategori --</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" @selected(old('category_id', $activity->category_id ?? '') == $category->id)>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
    @error('category_id')
        <p class="error">{{ $message }}</p>
    @enderror
</div>

<div class="form-group">
    <label for="status">Status</label>
    <select id="status" name="status">
        @foreach (['Draft', 'Published', 'Completed'] as $status)
            <option value="{{ $status }}" @selected(old('status', $activity->status ?? 'Planned') === $status)>
                {{ $status }}
            </option>
        @endforeach
    </select>
    @error('status')
        <p class="error">{{ $message }}</p>
    @enderror
</div>

<div class="form-group">
    <label for="poster">Poster Kegiatan</label>
    <input type="file" id="poster" name="poster" accept="image/*">
    @error('poster')
        <p class="error">{{ $message }}</p>
    @enderror

    @if(isset($activity) && $activity->poster_path)
        <div style="margin-top: 0.5rem;">
            <p>Poster saat ini:</p>
                <img src="{{ Storage::url($activity->poster_path) }}" alt="Poster width="200" style="border-radius: 6px;">
        </div>
    @endif
</div>
