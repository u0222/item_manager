<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>管理者一覧表示ページ</title>
</head>
<body>
    <h1>管理者一覧表示ページ</h1>
    <div>
        <a href="{{ url('admin/add') }}">新規登録</a>
    </div>
    <table>
        <thead>
            <tr>
                <td>id</td>
                <td>管理者名</td>
                <td>部署名</td>
                <td></td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            @foreach ($admins as $admin)
                <tr>
                    <td>{{ $admin->id }}</td>
                    <td>{{ $admin->name }}</td>
                    <td>{{ $admin->department->name }}</td>
                    <td>
                        <form action="{{ url('admin/edit/'. $admin->id) }}" method="get">
                            <input type="submit" value="編集">
                        </form>
                    </td>
                    <td>
                        <form action="{{ url('admin/delete/'. $admin->id) }}" method="post">
                            @csrf
                            <input type="submit" value="削除">
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>