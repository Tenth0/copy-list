@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{route('search_text')}}?title=" + title + "&category=" + category; method="GET">
        @csrf
        <div class="form-group">
            <input type="text" name="title" class="form-control" id="searchTitle" placeholder="タイトルを入力してください">
        </div>
        <div class="form-group">
            <select class="form-control" id="categoryName" name="category">
                <option value="">全てのカテゴリー</option>
                @foreach ($categories as $category)
                <option value="{{ $category->category_name }}">{{ $category->category_name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit">検索</button </form>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#textFormModal" data-bs-whatever="@mdo">
            新規作成
        </button>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#textEditModal" data-bs-whatever="@edit">
            編集
        </button>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#insertCategoryModal" data-bs-whatever="@category">
            カテゴリー作成
        </button>
        @foreach($texts as $i => $text)
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $text->title }}</div>
                    <div class="card-body">
                        {{ $text->text_content }}
                    </div>
                    <div class="card-footer card-flex">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">{{ $text->category_id_first }}</li>
                                <li class="breadcrumb-item">{{ $text->category_id_second }}</li>
                                <li class="breadcrumb-item">{{ $text->category_id_third }}</li>
                            </ol>
                        </nav>
                        <button id="copy-btn-{{$i}}" type="button" class="btn btn-primary copy-btn" data-text="{{ $text->text_content }}" onclick="copyText(this)">
                            コピーする
                        </button>
                        <button id="copy-btn-{{$i}}" type="button" class="btn btn-primary copy-btn" data-text="{{ $text->id }}" onclick="deleteText(this)">
                            削除
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach()
        <div id="toast-container"></div>
</div>
@extends('modals.textForm')
@extends('modals.insertCategory')
@endsection

<script>
    function copyText(element) {
        const textToCopy = element.getAttribute('data-text');
        navigator.clipboard.writeText(textToCopy).then(
            () => {
                alert("コピーしました")
            },
            () => {
                errorToast("失敗しました")
            }
        );
    }

    function deleteText(element) {
        if(!confirm('本当に削除しますか？')){
            return false;
        }
        const textId = element.getAttribute('data-text');
        const url = "{{ route('delete_text') }}?id=" + textId;
        fetch(url).then(
            () => {
                alert("削除しました")
                location.reload();
            },
            () => {
                errorToast("失敗しました")
            }
        );
    }

    function errorToast(message) {
        const toastContainer = document.getElementById('toast-container');
        const toast = document.createElement('div');
        toast.classList.add('toast', 'show');
        toast.setAttribute('role', 'alert');
        toast.setAttribute('aria-live', 'assertive');
        toast.setAttribute('aria-atomic', 'true');
        toast.innerHTML = `
        <div class="toast-body">
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        `;
        toastContainer.appendChild(toast);

        // 1秒後にトーストを削除する
        setTimeout(() => {
            toastContainer.removeChild(toast);
        }, 1000);
    }

    function performSearch() {
        let title = document.getElementById('searchTitle').value;
        let category = document.getElementById('categoryName').value;
        let url = "{{ route('search_text') }}?title=" + title + "&category=" + category;
        url.href = url;
    }
</script>