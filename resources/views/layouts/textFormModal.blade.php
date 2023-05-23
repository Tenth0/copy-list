<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">新しいテキストを作成する</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('insert_text') }}" method="post">
                    @csrf
                    @if(isset($categories))
                    <div class="mb-3">
                        <label for="category_name_first" class="col-form-label">カテゴリー１:</label>
                        <select name="category_name_first">
                            @foreach ($categories as $category)
                            <option value="{{$category}}">{{ $category }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="category_name_second" class="col-form-label">カテゴリー２:</label>
                        <select name="category_name_second">
                            @foreach ($categories as $category)
                            <option value="{{$category}}">{{ $category }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="category_name_third" class="col-form-label">カテゴリー３:</label>
                        <select name="category_name_third">
                            @foreach ($categories as $category)
                            <option value="{{$category}}">{{ $category }}</option>
                            @endforeach
                        </select>
                    </div>
                    @endif
                    <div class="mb-3">
                        <label for="text_content" class="col-form-label">テキスト:</label>
                        <textarea class="form-control" id="text_content" name="text_content"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">閉じる</button>
                        <button type="submit" class="btn btn-primary">追加</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
