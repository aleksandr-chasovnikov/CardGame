@extends('cardgame::layouts.admin_layout')

@section('inner_content')
    <table class="table">
    <thead>
    <tr style="background-color: #9696e4;color: #000;">
        <td>ID</td>
        <td style="min-width: 100px;">Наименование</td>
        <td style="min-width: 50px;">Видимость</td>
        <td style="min-width: 400px;">Описание</td>
        <td {{--style="min-width: 140px;"--}}>Аватар</td>
        <td style="min-width: 50px;">Сорт.</td>
        <td style="max-width: 20px;">Рейтинг</td>
        <td style="min-width: 120px;">Цена</td>
        <td></td>
        <td>Удалено</td>
        <td></td>
        <td></td>
    </tr>
    </thead>
    <tbody>
    <tr>
        <form action="{{ route('achievement.store') }}" method="post" role="form"
              enctype="multipart/form-data">
            <td></td>
            <td><input name="name" type="text" class="form-control"
                       id="name" value="{{ old('name') }}" required></td>
            <td>
                <select class="form-control" name="seen" id="seen">
                    <option selected value="1">Да</option>
                    <option value="0">Нет</option>
                </select>
            </td>
            <td><input name="description" type="text" class="form-control" id="description"
                       value="{{ old('description') }}"></td>
            <td><input name="avatar" type="file" class="form-control" id="avatar"
                       value="{{ old('avatar') }}"></td>
            <td><input name="sort" type="text" class="form-control"
                       id="sort" value="{{ old('sort') }}"></td>
            <td><input name="rating" type="text" class="form-control" id="rating"
                       value="{{ old('rating') }}"></td>
            <td><input name="price" type="text" class="form-control" id="price"
                       value="{{ old('price') }}"></td>
            <td></td>
            <td>
                <button type="submit" class="btn btn-xs btn-success">
                    <i class="fa fa-check"></i>
                </button>
            </td>
            <td></td>
            {{ csrf_field() }}
        </form>
    </tr>

    @foreach($achievements as $achievement)

        <tr @if ($achievement->deleted_at)
            style="background-color: #e4b9b9;"
            @elseif (!$achievement->seen)
            style="background-color: #9B859D;"
                @endif>
            <td>{{ $achievement->id }}</td>
            <td>{{ $achievement->name }}</td>
            <td>
                @if ($achievement->seen)
                    Да
                @else
                    Нет
                @endif
            </td>
            <td>{{ $achievement->description }}</td>
            <td><img width="50" src="{{ $achievement->avatar }}" alt=""></td>
            <td>{{ $achievement->sort }}</td>
            <td>{{ $achievement->rating }}</td>
            <td>{{ $achievement->price }}</td>
            <td>
                <a href="{{ route('achievementEdit',['id'=>$achievement->id]) }}"
                   role="button">
                    <button class="btn btn-xs btn-warning">
                        <i class="fa fa-edit"></i>
                    </button>
                </a>
            </td>
            <td>
                <form action="{{ route('achievement.destroy', ['id'=>$achievement->id]) }}"
                      method="post">
                    {{method_field('DELETE')}}
                    {{csrf_field()}}
                    <button class="btn btn-xs btn-danger">
                        <i class="fa fa-times"></i>
                    </button>
                </form>
            </td>
            <td>
                @if ($achievement->deleted_at)
                    <span class="label label-danger">Уд.</span>
                @endif
            </td>
            <td>
                <a href="{{ route('achievementRestore',['comment'=>$achievement->id]) }}"
                   role="button">
                    <button class="btn btn-xs btn-success">
                        <i class="fa fa-refresh"></i>
                    </button>
                </a>
            </td>
            <td>
                <form action="{{ route('achievementForceDelete', ['id'=>$achievement->id]) }}"
                      method="post">
                    {{method_field('DELETE')}}
                    {{csrf_field()}}
                    <button class="btn btn-xs btn-danger">
                        <i class="fa fa-trash-o"></i>
                    </button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
    </table>
@endsection