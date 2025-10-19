<style>
    .form-container { max-width: 800px; margin: 0 auto; padding: 20px; }
    .form-card { background: #2a2a2a; border: 1px solid #444; border-radius: 10px; padding: 30px; }
    body.light-theme .form-card { background: #F9FAFB; border-color: #ddd; }
    .form-group { margin-bottom: 1.5rem; }
    .form-label { display: block; color: #ffffff; font-weight: 600; margin-bottom: 0.5rem; }
    body.light-theme .form-label { color: #000000; }
    .form-control { width: 100%; padding: 10px; background-color: #1a1a1a; border: 1px solid #444; border-radius: 5px; color: #ffffff; font-size: 16px; }
    body.light-theme .form-control { background-color: #ffffff; border-color: #ddd; color: #000000; }
    .form-control:focus { outline: none; border-color: #6366f1; }
    .checkbox-label { display: flex; align-items: center; color: #cccccc; }
    body.light-theme .checkbox-label { color: #333; }
    .checkbox-input { margin-right: 8px; width: 18px; height: 18px; }
    .btn-primary { background-color: #6366f1; color: #ffffff; padding: 12px 24px; border: none; border-radius: 5px; font-weight: 600; cursor: pointer; transition: all 0.3s ease; }
    .btn-primary:hover { background-color: #4f46e5; }
    .btn-secondary { background-color: #6b7280; color: #ffffff; padding: 12px 24px; border: none; border-radius: 5px; font-weight: 600; cursor: pointer; text-decoration: none; display: inline-block; margin-left: 10px; }
    .btn-secondary:hover { background-color: #4b5563; }
    .error-message { color: #ef4444; font-size: 14px; margin-top: 5px; }
</style>

<div class="form-container">
    <div class="form-card">
        <h1 style="color: #ffffff; margin-bottom: 20px;">{{ $submitText }}</h1>

        <form action="{{ $action }}" method="POST">
            @csrf
            @if($method !== 'POST')
                @method($method)
            @endif

            <div class="form-group">
                <label class="form-label">Vraag *</label>
                <input type="text" name="question" class="form-control" value="{{ old('question', $faq->question ?? '') }}" required maxlength="500">
                @error('question')<p class="error-message">{{ $message }}</p>@enderror
            </div>

            <div class="form-group">
                <label class="form-label">Antwoord *</label>
                <textarea name="answer" class="form-control" rows="6" required>{{ old('answer', $faq->answer ?? '') }}</textarea>
                @error('answer')<p class="error-message">{{ $message }}</p>@enderror
            </div>

            <div class="form-group">
                <label class="form-label">Categorie *</label>
                <select name="category" class="form-control" required>
                    @foreach($categories as $category)
                        <option value="{{ $category }}" {{ old('category', $faq->category ?? '') === $category ? 'selected' : '' }}>
                            {{ $category }}
                        </option>
                    @endforeach
                </select>
                @error('category')<p class="error-message">{{ $message }}</p>@enderror
            </div>

            <div class="form-group">
                <label class="form-label">Volgorde (0 = eerst)</label>
                <input type="number" name="order" class="form-control" value="{{ old('order', $faq->order ?? 0) }}" min="0">
                @error('order')<p class="error-message">{{ $message }}</p>@enderror
            </div>

            <div class="form-group">
                <label class="checkbox-label">
                    <input type="checkbox" name="is_published" class="checkbox-input" {{ old('is_published', $faq->is_published ?? true) ? 'checked' : '' }}>
                    Gepubliceerd (zichtbaar voor bezoekers)
                </label>
                @error('is_published')<p class="error-message">{{ $message }}</p>@enderror
            </div>

            <div style="margin-top: 2rem;">
                <button type="submit" class="btn-primary">{{ $submitText }}</button>
                <a href="{{ route('admin.faq.index') }}" class="btn-secondary">Annuleren</a>
            </div>
        </form>
    </div>
</div>

<style>
    body.light-theme h1 { color: #000000 !important; }
</style>
