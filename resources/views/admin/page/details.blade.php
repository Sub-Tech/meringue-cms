<div class="panel panel-flat">
    <div class="panel-body">

        <form action="{{ route('admin.page.update', ['page' => $page->id]) }}" method="post">

            {{ method_field('PATCH') }}

            <div class="form-group">
                <label for="title">Title</label>
                <input id="title" name="name" class="form-control">
            </div>

            <div class="form-group">
                <label for="slug">Slug</label>
                <input id="slug" name="slug" class="form-control">
            </div>

            <div class="form-group">
                <label for="homepage">Homepage</label>
                <input type="checkbox" name="homepage" class="checkbox" id="homepage">
            </div>

            <input type="submit" class="btn btn-primary">
        </form>

    </div>
</div>
