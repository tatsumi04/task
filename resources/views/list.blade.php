@extends('layouts.app')
@section('title', '商品情報一覧画面')
@section('content')
<div class="com-infoList">
    <h2>商品情報一覧</h2>
    @if (session('err_msg'))
    <p class="text-denger">
        {{ session('err_msg') }}
    </p>
    @endif

    <form method="GET" action="{{ route('serch') }}">
    @csrf
    <div class="serch-form">
        <h3>検索フォーム</h3>
        <div class="serch-name">
        <label for="serch">商品名</label>
        <input id="serch" type="text" name="search" >
    <div>
    </div>

    <div class="serch-maker">
        <label for="maker">メーカー名</label>
        <select name="makerName-selecter" id="maker">
        <option value="未選択">未選択</option>
            <option value="企業A">企業A</option>
            <option value="企業B">企業B</option>
            <option value="企業C">企業C</option>
        </select>
    </div>

    <div class="serch">
        <button type="submit" onclick=>検索</button>
    </div>
    </form>

    <div class="return">
        <a href="{{ route('commodity') }}">新規登録</a>
        <p></p>
    </div>

    <table class="table table-striped">
        <tr>
            <th>id</th>
            <th>商品画像</th>
            <th>商品名</th>
            <th>価格</th>
            <th>在庫数</th>
            <th>メーカー名</th>
            <th>詳細表示</th>
            <th>削除</th>
        </tr>

        @foreach($products as $product)
          <tr>
              <td>{{ $product->id }}</td>
              <td><img src="{{ asset('storage/'.$product->image_path) }}" class="img" height="30" width="30"></td>
              <td><a href="/task/public/detail/{{ $product->id }}">{{ $product->product_name }}</a></td>
              <td>{{ $product->price }}</td>
              <td>{{ $product->stock }}</td>
              <td>{{ $product->company_id }}</td>
              <td><a href="/task/public/detail/{{ $product->id }}">詳細表示</a></td>
              <form method="POST" action="{{ route('delete' , $product->id) }}" onSubmit="return checkDelete()">
              @csrf
              <td><button type="submit" class="delete" onclick=>削除</button></td>       
              </form>
          </tr>
          @endforeach
    </table>
</div>

<script>
    function checkDelete(){
        if(window.confirm('削除してよろしいですか？')){
            return true;
        } else {
            return false;
        }
    }
</script>
@endsection