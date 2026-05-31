<div class="mb-4">
    <label class="text-xs font-medium text-gray-400">Título</label>
    <input type="text" name="title" class="w-full p-2 bg-neutral-800 border border-neutral-700 rounded-md text-gray-100 focus:outline-none focus:border-blue-500" value="{{ old('title', $question->title ?? '') }}" />
    @error('title')<div class="text-red-500 text-xs">{{ $message }}</div>@enderror
</div>
<div class="mb-4">
    <label class="text-xs font-medium text-gray-400">Categoría</label>
    <select name="category_id" class="w-full p-2 bg-neutral-800 border border-neutral-700 rounded-md text-gray-100 appearance-none focus:outline-none focus:border-blue-500">
        <option value="">Seleccione una categoría</option>
        @foreach ($categories as $category)
        <option value="{{ $category->id }}" @if ($category->id == old('category_id', $question->category_id ?? '')) selected @endif>
            {{ $category->name }}
        </option>
        @endforeach
    </select>
    @error('category_id')<div class="text-red-500 text-xs">{{ $message }}</div>@enderror
</div>
<div class="mb-4">
    <label class="text-xs font-medium text-gray-400">Descripción</label>
    <textarea name="description" rows="6" class="w-full p-2 bg-neutral-800 border border-neutral-700 rounded-md text-gray-100 focus:outline-none focus:border-blue-500">{{ old('description', $question->description ?? '') }}</textarea>
    @error('description')<div class="text-red-500 text-xs">{{ $message }}</div>@enderror
</div>
