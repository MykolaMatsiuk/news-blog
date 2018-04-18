@extends('admin.layouts.app')

@section('main')
  <div class="content-box-large">
    <div class="panel-heading">
      <div class="panel-title">Підменю</div>
      <a href="/admin/submenu/create" class="btn btn-success">Новий елемент підменю</a>
    </div>
    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif
    <div class="panel-body">
      <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
      <thead>
        <tr>
          <th>Заголовок</th>
          <th>Відповідний елемент меню</th>
          <th>Дата створення</th>
          <th>Дата оновлення</th> 
          <th><span class="glyphicon glyphicon-edit"></span></th>
          <th><span class="glyphicon glyphicon-trash"></span></th>         
        </tr>
      </thead>
      <tbody>
          @foreach ($items as $item)
          <tr>
            <td>
              {{ $item->title }}
            </td>
            @if($item->navmenu->count())
              <td>
                {{ $item->navmenu->title }}
              </td>
            @endif
            <td>
              {{ $item->created_at }}
            </td>
            <td>
              {{ $item->updated_at }}
            </td>
            <td>
              <a href="{{ route('submenu.edit', $item->id) }}" class="btn btn-warning btn-sm">
                Редагувати
              </a>
            </td>
            <td>
              <form id="delete-form-{{ $item->id }}" method="post" action="{{ route('submenu.destroy', $item->id) }}" style="display: none">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
              </form>
              <button type="button" class="btn btn-danger btn-sm" onclick="
                if(confirm('Видалити елемент?')) {
                  event.preventDefault();
                  document.getElementById('delete-form-{{ $item->id }}').submit();
                } else {
                  event.preventDefault();
                }">
                Видалити
              </button>
            </td>
          </tr>
          @endforeach
      </tbody>
    </table>
    {{ $items->links() }}
    </div>
  </div>

@endsection
