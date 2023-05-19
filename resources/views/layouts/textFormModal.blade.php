<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">新しいテキストを作成する</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('insert_text') }}" method="post">
                    @if(isset($categories))
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">カテゴリー１:</label>
                        <select>
                            @foreach ($categories as $category)
                            <option value="{{$category}}">{{ $category }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">カテゴリー２:</label>
                        <select>
                            @foreach ($categories as $category)
                            <option value="{{$category}}">{{ $category }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">カテゴリー３:</label>
                        <select>
                            @foreach ($categories as $category)
                            <option value="{{$category}}">{{ $category }}</option>
                            @endforeach
                        </select>
                    </div>
                    @endif
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">テキスト:</label>
                        <textarea class="form-control" id="message-text"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">閉じる</button>
                <button type="button" class="btn btn-primary">追加</button>
            </div>
        </div>
    </div>
</div>