<div class="modal fade" id="textFormModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">新しいテキストを作成する</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('insert_text') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="col-form-label">タイトル：</label>
                        <input type="text" class="form-control" id="title" name="title"></input>
                    </div>
                    @if(count($categories) >= 1)
                    <div class="mb-3">
                        <label for="category_name_first" class="col-form-label">カテゴリー１：</label>
                        <select name="category_name_first">
                            <option value="">カテゴリーを選択できます</option>
                            @foreach ($categories as $category)
                            <option value="{{$category->category_name}}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @endif
                    @if(count($categories) >= 2)
                    <div class="mb-3">
                        <label for="category_name_second" class="col-form-label">カテゴリー２：</label>
                        <select name="category_name_second">
                            <option value="">カテゴリーを選択できます</option>
                            @foreach ($categories as $category)
                            <option value="{{$category->category_name}}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @endif
                    @if(count($categories) >= 3)
                    <div class="mb-3">
                        <label for="category_name_third" class="col-form-label">カテゴリー３：</label>
                        <select name="category_name_third">
                            <option value="">カテゴリーを選択できます</option>
                            @foreach ($categories as $category)
                            <option value="{{$category->category_name}}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @endif
                    <div class="mb-3">
                        <label for="text_content" class="col-form-label">テキスト：</label>
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