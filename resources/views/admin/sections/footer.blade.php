<footer class="main-footer d-flex justify-content-end">
    <div class="container">
        Пользователь:
        <a href="{{ route('admin.users.edit', ['id' => Auth::user()->id]) }}">
            {{ Auth::user()->name }}
        </a>
    </div>
</footer>
