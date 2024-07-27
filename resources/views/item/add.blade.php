 <form action="{{ url('item/add') }}" method="post">
    @csrf
    <!-- 商品名 -->
    <div>
        <label>商品名</label>
    </div>
    <div>
        <!-- value属性にold('name')と記述することで登録ボタンクリック後でも元々入力していた値の再表示が可能 -->
        <input
            type="text" 
            name="name" 
            value="{{ old('name') }}" 
            placeholder="商品名を入力してください">
        {{-- HTMLには表示されないコメントアウト（通常のコメントアウトでは@errorのような記述はエラーとなる） --}}
        {{-- @error('name')内の$messageは入力エラーがあった場合に表示 --}}
        @error('name')
            <div>{{ $message }}</div>
        @enderror
    </div>
    <!-- 価格 -->
    <div>
        <label>価格</label>
    </div>
    <div>
        <input
            type="number"
            name="price" 
            value="{{ old('price') }}" 
            placeholder="価格を入力してください">
        @error('price')
            <div>{{ $message }}</div>
        @enderror
    </div>
    <!-- カテゴリ -->
    <div>
        <label>カテゴリ</label>
    </div>
    <div>
        <select name="category_id">
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" 
                    {{ (int)old('category_id')===$category->id ? 'selected' : '' }}
                    >{{ $category->name }}
                </option>
            @endforeach
        </select>
        @error('category_id')
            <div>{{ $message }}</div>
        @enderror
    </div>
    <div>
        <input type="submit" name="send" value="登録する">
    </div>
    <div>
        <!-- 一覧に戻る -->
        <a href="{{ url('item') }}">戻る</a>
    </div>
</form>