@extends('layouts.app')

@section('content')
<div class="container">

    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">
        新規作成
    </button>
    @foreach($texts as $i => $text)
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    {{ $text->text_content }}
                </div>
                <div class="card-footer">
                    <button id="copy-btn-{{$i}}" type="button" class="btn btn-primary copy-btn" data-text="{{ $text->text_content }}" onclick="copyText(this)">
                        コピーする
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endforeach()
    <div id="toast-container"></div>
</div>
@extends('layouts.textFormModal')
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
</script>